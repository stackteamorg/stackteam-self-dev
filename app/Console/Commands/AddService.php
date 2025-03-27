<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Service;
use Illuminate\Console\Command;

class AddService extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service
                            {--name= : The name of the service}
                            {--title= : The title of the service}
                            {--description= : The description of the service}
                            {--icon= : The icon class of the service}
                            {--lang=fa : The language of the service}
                            {--parent= : The ID of the parent service (if it\'s a child service)}
                            {--article= : The ID of the related article}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a new service to the database';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name') ?: $this->ask('What is the name of the service?');
        $title = $this->option('title') ?: $this->ask('What is the title of the service?');
        $description = $this->option('description') ?: $this->ask('What is the description of the service?');
        $icon = $this->option('icon') ?: $this->ask('What is the icon class of the service? (Press enter to skip)', null);
        $lang = $this->option('lang') ?: $this->choice('What is the language of the service?', ['fa', 'en', 'ar', 'ru', 'fr', 'es', 'de'], 0);
        
        // Check for parent service
        $parentId = $this->option('parent');
        if ($parentId === null && $this->confirm('Is this a child service?', false)) {
            // List all primary services for selection
            $primaryServices = Service::primary()->byLang($lang)->get();
            
            if ($primaryServices->isEmpty()) {
                $this->error('No primary services found. Create a primary service first.');
                return 1;
            }
            
            $this->info('Available primary services:');
            $primaryServices->each(function ($service) {
                $this->line("[{$service->id}] {$service->name}");
            });
            
            $parentId = $this->ask('Enter the ID of the parent service');
        }
        
        // Check for related article
        $articleId = $this->option('article');
        if ($articleId === null && $this->confirm('Do you want to associate this service with an article?', false)) {
            $articles = Article::all();
            
            if ($articles->isEmpty()) {
                $this->warn('No articles found.');
            } else {
                $this->info('Available articles:');
                $articles->each(function ($article) {
                    $this->line("[{$article->id}] {$article->title}");
                });
                
                $articleId = $this->ask('Enter the ID of the article');
            }
        }
        
        // Create the service
        $service = Service::create([
            'name' => $name,
            'title' => $title,
            'description' => $description,
            'icon' => $icon,
            'lang' => $lang,
            'parent_id' => $parentId,
            'article_id' => $articleId,
        ]);
        
        $this->info("Service '{$service->name}' has been created successfully with ID: {$service->id}");
        
        return Command::SUCCESS;
    }
}
