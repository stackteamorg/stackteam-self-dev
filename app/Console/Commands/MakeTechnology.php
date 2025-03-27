<?php

namespace App\Console\Commands;

use App\Models\Technology;
use App\Models\TechnologySection;
use Illuminate\Console\Command;

class MakeTechnology extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:tech
                            {--name= : Technology name}
                            {--title= : Technology title}
                            {--description= : Technology description}
                            {--icon= : Technology icon}
                            {--lang=fa : Technology language}
                            {--section= : Technology section ID}
                            {--article= : Related article ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new technology';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name') ?: $this->ask('Please enter the technology name');
        $title = $this->option('title') ?: $this->ask('Please enter the technology title');
        $description = $this->option('description') ?: $this->ask('Please enter the technology description');
        $icon = $this->option('icon') ?: $this->ask('Please enter the technology icon (press Enter to skip)', null);
        $lang = $this->option('lang') ?: $this->choice('Please select the technology language', ['fa', 'en', 'ar', 'ru', 'fr', 'es', 'de'], 0);
        
        // Select technology section
        $sectionId = $this->option('section');
        if ($sectionId === null) {
            // List all technology sections for selection
            $sections = TechnologySection::byLang($lang)->get();
            
            if ($sections->isEmpty()) {
                $this->warn('No technology section found. Please create a technology section first.');
                
                if ($this->confirm('Do you want to create a new technology section?', true)) {
                    $sectionName = $this->ask('Please enter the technology section name');
                    $sectionTitle = $this->ask('Please enter the technology section title');
                    $sectionDescription = $this->ask('Please enter the technology section description');
                    
                    $section = TechnologySection::create([
                        'name' => $sectionName,
                        'title' => $sectionTitle,
                        'description' => $sectionDescription,
                        'lang' => $lang,
                    ]);
                    
                    $this->info("Technology section '{$section->name}' created successfully. ID: {$section->id}");
                    $sectionId = $section->id;
                } else {
                    $this->error('Cannot create technology without a section.');
                    return 1;
                }
            } else {
                $this->info('Available technology sections:');
                $sections->each(function ($section) {
                    $this->line("[{$section->id}] {$section->name}");
                });
                
                $sectionId = $this->ask('Please enter the technology section ID');
            }
        }
        
        // Check related article
        $articleId = $this->option('article');
        if ($articleId === null && $this->confirm('Do you want to link this technology to an article?', false)) {
            $articles = \App\Models\Article::all();
            
            if ($articles->isEmpty()) {
                $this->warn('No articles found.');
            } else {
                $this->info('Available articles:');
                $articles->each(function ($article) {
                    $this->line("[{$article->id}] {$article->title}");
                });
                
                $articleId = $this->ask('Please enter the related article ID');
            }
        }
        
        // Create technology
        $technology = Technology::create([
            'name' => $name,
            'title' => $title,
            'description' => $description,
            'icon' => $icon,
            'lang' => $lang,
            'technology_section_id' => $sectionId,
            'article_id' => $articleId,
        ]);
        
        $this->info("Technology '{$technology->name}' created successfully. ID: {$technology->id}");
        
        return Command::SUCCESS;
    }
}
