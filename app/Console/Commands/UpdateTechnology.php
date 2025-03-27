<?php

namespace App\Console\Commands;

use App\Models\Technology;
use App\Models\TechnologySection;
use Illuminate\Console\Command;

class UpdateTechnology extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:tech {id : Technology ID}
                            {--name= : Technology name}
                            {--title= : Technology title}
                            {--description= : Technology description}
                            {--icon= : Technology icon}
                            {--lang= : Technology language}
                            {--section= : Technology section ID}
                            {--article= : Related article ID (0 to remove link)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update an existing technology';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $id = $this->argument('id');
        
        // Find the technology
        $technology = Technology::find($id);
        
        if (!$technology) {
            $this->error("Technology with ID {$id} not found.");
            return 1;
        }
        
        $this->info("Editing technology: {$technology->name} (ID: {$technology->id})");
        
        // Get values for update
        $data = [];
        
        if ($this->option('name')) {
            $data['name'] = $this->option('name');
        } elseif ($this->confirm('Do you want to update the name?', false)) {
            $data['name'] = $this->ask('Enter new name', $technology->name);
        }
        
        if ($this->option('title')) {
            $data['title'] = $this->option('title');
        } elseif ($this->confirm('Do you want to update the title?', false)) {
            $data['title'] = $this->ask('Enter new title', $technology->title);
        }
        
        if ($this->option('description')) {
            $data['description'] = $this->option('description');
        } elseif ($this->confirm('Do you want to update the description?', false)) {
            $data['description'] = $this->ask('Enter new description', $technology->description);
        }
        
        if ($this->option('icon')) {
            $data['icon'] = $this->option('icon');
        } elseif ($this->confirm('Do you want to update the icon?', false)) {
            $data['icon'] = $this->ask('Enter new icon', $technology->icon);
        }
        
        if ($this->option('lang')) {
            $data['lang'] = $this->option('lang');
        } elseif ($this->confirm('Do you want to update the language?', false)) {
            $data['lang'] = $this->choice('Select new language', ['fa', 'en', 'ar', 'ru', 'fr', 'es', 'de'], array_search($technology->lang, ['fa', 'en', 'ar', 'ru', 'fr', 'es', 'de']) ?: 0);
        }
        
        // Manage technology_section_id
        $sectionIdOption = $this->option('section');
        if ($sectionIdOption !== null) {
            $data['technology_section_id'] = $sectionIdOption;
        } elseif ($this->confirm('Do you want to change the technology section?', false)) {
            // List all technology sections for selection
            $sections = TechnologySection::byLang($technology->lang)->get();
            
            if ($sections->isEmpty()) {
                $this->error('No technology section found.');
            } else {
                $this->info('Available technology sections:');
                $sections->each(function ($section) use ($technology) {
                    $marker = ($section->id == $technology->technology_section_id) ? '* ' : '';
                    $this->line("[{$section->id}] {$marker}{$section->name}");
                });
                
                $data['technology_section_id'] = $this->ask('Enter new technology section ID');
            }
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
                    $articles->each(function ($article) use ($technology) {
                        $marker = ($article->id == $technology->article_id) ? '* ' : '';
                        $this->line("[{$article->id}] {$marker}{$article->title}");
                    });
                    
                    $data['article_id'] = $this->ask('Enter related article ID');
                }
            }
        }
        
        // Update technology if there are changes
        if (empty($data)) {
            $this->info('No changes were made to the technology.');
        } else {
            $technology->update($data);
            $this->info("Technology '{$technology->name}' updated successfully.");
        }
        
        return Command::SUCCESS;
    }
}
