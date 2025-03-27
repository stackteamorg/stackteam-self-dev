<?php

namespace App\Console\Commands;

use App\Models\TechnologySection;
use Illuminate\Console\Command;

class UpdateTechnologySection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:techsec {id : Technology section ID}
                            {--name= : Technology section name}
                            {--title= : Technology section title}
                            {--description= : Technology section description}
                            {--icon= : Technology section icon}
                            {--lang= : Technology section language}
                            {--article= : Related article ID (0 to remove link)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update an existing technology section';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        
        // Find the technology section
        $section = TechnologySection::find($id);
        
        if (!$section) {
            $this->error("Technology section with ID {$id} not found.");
            return 1;
        }
        
        $this->info("Editing technology section: {$section->name} (ID: {$section->id})");
        
        // Get values for update
        $data = [];
        
        if ($this->option('name')) {
            $data['name'] = $this->option('name');
        } elseif ($this->confirm('Do you want to update the name?', false)) {
            $data['name'] = $this->ask('Enter new name', $section->name);
        }
        
        if ($this->option('title')) {
            $data['title'] = $this->option('title');
        } elseif ($this->confirm('Do you want to update the title?', false)) {
            $data['title'] = $this->ask('Enter new title', $section->title);
        }
        
        if ($this->option('description')) {
            $data['description'] = $this->option('description');
        } elseif ($this->confirm('Do you want to update the description?', false)) {
            $data['description'] = $this->ask('Enter new description', $section->description);
        }
        
        if ($this->option('icon')) {
            $data['icon'] = $this->option('icon');
        } elseif ($this->confirm('Do you want to update the icon?', false)) {
            $data['icon'] = $this->ask('Enter new icon', $section->icon);
        }
        
        if ($this->option('lang')) {
            $data['lang'] = $this->option('lang');
        } elseif ($this->confirm('Do you want to update the language?', false)) {
            $data['lang'] = $this->choice('Select new language', ['fa', 'en', 'ar', 'ru', 'fr', 'es', 'de'], array_search($section->lang, ['fa', 'en', 'ar', 'ru', 'fr', 'es', 'de']) ?: 0);
        }
        
        // Manage article_id
        $articleIdOption = $this->option('article');
        if ($articleIdOption !== null) {
            $data['article_id'] = $articleIdOption == 0 ? null : $articleIdOption;
        } elseif ($this->confirm('Do you want to update the related article?', false)) {
            $removeArticle = $this->confirm('Do you want to remove the link to the article?', false);
            
            if ($removeArticle) {
                $data['article_id'] = null;
            } else {
                $articles = \App\Models\Article::all();
                
                if ($articles->isEmpty()) {
                    $this->warn('No articles found.');
                } else {
                    $this->info('Available articles:');
                    $articles->each(function ($article) {
                        $this->line("[{$article->id}] {$article->title}");
                    });
                    
                    $data['article_id'] = $this->ask('Enter related article ID');
                }
            }
        }
        
        // Update technology section if there are changes
        if (empty($data)) {
            $this->info('No changes were made to the technology section.');
        } else {
            $section->update($data);
            $this->info("Technology section '{$section->name}' updated successfully.");
        }
        
        return Command::SUCCESS;
    }
}
