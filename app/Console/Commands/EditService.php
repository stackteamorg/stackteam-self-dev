<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Service;
use Illuminate\Console\Command;

class EditService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:service {id : The ID of the service to edit}
                            {--name= : The name of the service}
                            {--title= : The title of the service}
                            {--description= : The description of the service}
                            {--icon= : The icon class of the service}
                            {--lang= : The language of the service}
                            {--parent= : The ID of the parent service (or 0 to remove)}
                            {--article= : The ID of the related article (or 0 to remove)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Edit an existing service in the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        
        // Find the service
        $service = Service::find($id);
        
        if (!$service) {
            $this->error("Service with ID {$id} not found.");
            return 1;
        }
        
        $this->info("Editing service: {$service->name} (ID: {$service->id})");
        
        // Get values to update
        $data = [];
        
        if ($this->option('name')) {
            $data['name'] = $this->option('name');
        } elseif ($this->confirm('Do you want to update the name?', false)) {
            $data['name'] = $this->ask('Enter the new name', $service->name);
        }
        
        if ($this->option('title')) {
            $data['title'] = $this->option('title');
        } elseif ($this->confirm('Do you want to update the title?', false)) {
            $data['title'] = $this->ask('Enter the new title', $service->title);
        }
        
        if ($this->option('description')) {
            $data['description'] = $this->option('description');
        } elseif ($this->confirm('Do you want to update the description?', false)) {
            $data['description'] = $this->ask('Enter the new description', $service->description);
        }
        
        if ($this->option('icon')) {
            $data['icon'] = $this->option('icon');
        } elseif ($this->confirm('Do you want to update the icon?', false)) {
            $data['icon'] = $this->ask('Enter the new icon class', $service->icon);
        }
        
        if ($this->option('lang')) {
            $data['lang'] = $this->option('lang');
        } elseif ($this->confirm('Do you want to update the language?', false)) {
            $data['lang'] = $this->choice('Select the new language', ['fa', 'en', 'ar', 'ru', 'fr', 'es', 'de'], array_search($service->lang, ['fa', 'en', 'ar', 'ru', 'fr', 'es', 'de']) ?: 0);
        }
        
        // Handle parent_id
        $parentIdOption = $this->option('parent');
        if ($parentIdOption !== null) {
            $data['parent_id'] = $parentIdOption == 0 ? null : $parentIdOption;
        } elseif ($this->confirm('Do you want to update the parent service?', false)) {
            $makeItPrimary = $this->confirm('Do you want to make this a primary service (no parent)?', $service->parent_id === null);
            
            if ($makeItPrimary) {
                $data['parent_id'] = null;
            } else {
                // List all primary services for selection
                $primaryServices = Service::primary()
                    ->byLang($service->lang)
                    ->where('id', '!=', $service->id) // Exclude the current service
                    ->get();
                
                if ($primaryServices->isEmpty()) {
                    $this->error('No other primary services found.');
                } else {
                    $this->info('Available primary services:');
                    $primaryServices->each(function ($primaryService) {
                        $this->line("[{$primaryService->id}] {$primaryService->name}");
                    });
                    
                    $data['parent_id'] = $this->ask('Enter the ID of the parent service');
                }
            }
        }
        
        // Handle article_id
        $articleIdOption = $this->option('article');
        if ($articleIdOption !== null) {
            $data['article_id'] = $articleIdOption == 0 ? null : $articleIdOption;
        } elseif ($this->confirm('Do you want to update the related article?', false)) {
            $removeArticle = $this->confirm('Do you want to remove the related article?', false);
            
            if ($removeArticle) {
                $data['article_id'] = null;
            } else {
                $articles = Article::all();
                
                if ($articles->isEmpty()) {
                    $this->warn('No articles found.');
                } else {
                    $this->info('Available articles:');
                    $articles->each(function ($article) {
                        $this->line("[{$article->id}] {$article->title}");
                    });
                    
                    $data['article_id'] = $this->ask('Enter the ID of the article');
                }
            }
        }
        
        // Update the service if there are changes
        if (empty($data)) {
            $this->info('No changes were made to the service.');
        } else {
            $service->update($data);
            $this->info("Service '{$service->name}' has been updated successfully.");
        }
        
        return Command::SUCCESS;
    }
}
