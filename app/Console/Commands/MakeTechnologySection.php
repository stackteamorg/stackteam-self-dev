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
                            {--lang=fa : Technology section language}';

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
        
        // Create technology section
        $technologySection = TechnologySection::create([
            'name' => $name,
            'title' => $title,
            'description' => $description,
            'icon' => $icon,
            'lang' => $lang,
            'article_id' => null, // Set article_id to null as per the instruction
        ]);
        
        $this->info("Technology section '{$technologySection->name}' created successfully. ID: {$technologySection->id}");
        
        return Command::SUCCESS;
    }
}
