<?php

namespace App\Console\Commands;

use App\Models\TechnologySection;
use Illuminate\Console\Command;

class MakeTechnologySection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:techsec
                            {--name= : Technology section name}
                            {--title= : Technology section title}
                            {--description= : Technology section description}
                            {--icon= : Technology section icon}
                            {--lang=fa : Technology section language}
                            {--article= : Related article ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new technology section';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name') ?: $this->ask('Please enter the technology section name');
        $title = $this->option('title') ?: $this->ask('Please enter the technology section title');
        $description = $this->option('description') ?: $this->ask('Please enter the technology section description');
        $icon = $this->option('icon') ?: $this->ask('Please enter the technology section icon (press Enter to skip)', null);
        $lang = $this->option('lang') ?: $this->choice('Please select the technology section language', ['fa', 'en', 'ar', 'ru', 'fr', 'es', 'de'], 0);
        
        // Check related article
        $articleId = $this->option('article');
        if ($articleId === null && $this->confirm('Do you want to link this technology section to a related article?', false)) {
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
        
        // Create technology section
        $technologySection = TechnologySection::create([
            'name' => $name,
            'title' => $title,
            'description' => $description,
            'icon' => $icon,
            'lang' => $lang,
            'article_id' => $articleId,
        ]);
        
        $this->info("Technology section '{$technologySection->name}' created successfully. ID: {$technologySection->id}");
        
        return Command::SUCCESS;
    }
}
