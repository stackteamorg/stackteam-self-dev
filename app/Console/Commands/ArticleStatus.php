<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use Illuminate\Support\Facades\Schema;

class ArticleStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'article:status {id? : The ID of the article to check status}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display the status of an article';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $id = $this->argument('id');
        
        if (!$id) {
            $id = $this->askForArticleId();
        }
        
        $article = $this->findArticle($id);
        
        if (!$article) {
            $this->error("Article with ID {$id} not found.");
            return 1; // Command failed
        }
        
        $this->displayArticleStatus($article);
        
        // Ask if user wants to change the status
        if ($this->confirm('Do you want to change the article status?', false)) {
            $this->changeArticleStatus($article);
        }
        
        return 0; // Command succeeded
    }

    /**
     * Ask the user to select an article ID.
     *
     * @return int
     */
    private function askForArticleId(): int
    {
        $articles = Article::orderBy('id')->get(['id', 'title']);
        
        if ($articles->isEmpty()) {
            $this->error('No articles found in the database.');
            exit(1);
        }
        
        $this->info('Available articles:');
        $articles->each(function ($article) {
            $this->line("[{$article->id}] {$article->title}");
        });
        
        return $this->ask('Enter the ID of the article you want to check status');
    }

    /**
     * Find an article by its ID.
     *
     * @param int $id
     * @return Article|null
     */
    private function findArticle(int $id): ?Article
    {
        return Article::find($id);
    }

    /**
     * Display status information about the selected article.
     *
     * @param Article $article
     * @return void
     */
    private function displayArticleStatus(Article $article): void
    {
        $this->newLine();
        $this->info('📋 <fg=bright-yellow;bg=blue>ARTICLE STATUS INFORMATION</fg=bright-yellow;bg=blue>');
        $this->newLine();
        
        // Main article information with colors
        $this->line("<fg=bright-cyan>ID:</> <fg=bright-white>{$article->id}</>");
        $this->line("<fg=bright-cyan>Title:</> <fg=bright-white>{$article->title}</>");
        
        // Check if status column exists in the articles table
        if (Schema::hasColumn('articles', 'status')) {
            $statusText = $this->getStatusText($article->status);
            $statusColor = match ($article->status) {
                'published' => 'bright-green',
                'draft' => 'bright-yellow',
                'archived' => 'gray',
                'suspended' => 'bright-red',
                default => 'white',
            };
            $this->line("<fg=bright-cyan>Status:</> <fg={$statusColor}>{$statusText}</>");
        } else {
            $this->warn("⚠️ Status field is not available in the articles table.");
            $this->line("<fg=bright-yellow>To add status functionality, you need to create a migration:</>");
            $this->line("<fg=bright-green>php artisan make:migration add_status_to_articles_table</>");
            $this->newLine();
            $this->line("<fg=bright-yellow>In the migration file, add:</>");
            $this->line("<fg=bright-green>\$table->string(\"status\")->default(\"draft\");</>");
        }
        
        // Additional status information with section header
        $this->newLine();
        $this->info('📅 <fg=bright-magenta>ADDITIONAL INFORMATION</fg=bright-magenta>');
        $this->line("<fg=bright-cyan>Created At:</> <fg=bright-white>" . $article->created_at->format('Y-m-d H:i:s') . "</>");
        $this->line("<fg=bright-cyan>Updated At:</> <fg=bright-white>" . $article->updated_at->format('Y-m-d H:i:s') . "</>");
        
        // Content information with section header
        $this->newLine();
        $this->info('📝 <fg=bright-magenta>CONTENT INFORMATION</fg=bright-magenta>');
        $contentLength = strlen($article->content);
        $contentLengthColor = $contentLength > 1000 ? 'bright-green' : 'bright-yellow';
        $this->line("<fg=bright-cyan>Content Length:</> <fg={$contentLengthColor}>{$contentLength} characters</>");
        
        // Relationships with section header
        $this->newLine();
        $this->info('🔗 <fg=bright-magenta>RELATIONSHIPS</fg=bright-magenta>');
        $authorName = $article->author ? $article->author->name : 'None';
        $authorColor = $article->author ? 'bright-green' : 'bright-red';
        $this->line("<fg=bright-cyan>Author:</> <fg={$authorColor}>{$authorName}</>");
        
        $categoryName = $article->category ? $article->category->name : 'None';
        $categoryColor = $article->category ? 'bright-green' : 'bright-red';
        $this->line("<fg=bright-cyan>Category:</> <fg={$categoryColor}>{$categoryName}</>");
        
        $tagCount = $article->tags()->count();
        $tagColor = $tagCount > 0 ? 'bright-green' : 'bright-yellow';
        $this->line("<fg=bright-cyan>Tags:</> <fg={$tagColor}>{$tagCount}</>");
        
        if ($tagCount > 0) {
            $tags = $article->tags()->pluck('name')->implode(', ');
            $this->line("<fg=bright-cyan>Tag List:</> <fg=bright-white>{$tags}</>");
        }
        
        $this->newLine();
    }
    
    /**
     * Change the status of an article.
     *
     * @param Article $article
     * @return void
     */
    private function changeArticleStatus(Article $article): void
    {
        // Check if status column exists in the articles table
        if (!Schema::hasColumn('articles', 'status')) {
            $this->error('Status field is not available in the articles table. Please add it first.');
            
            if ($this->confirm('Do you want to create a migration for the status field now?', true)) {
                $this->call('make:migration', [
                    'name' => 'add_status_to_articles_table'
                ]);
                
                $this->info('Migration created! After editing the migration file, run:');
                $this->line('<fg=bright-green>php artisan migrate</>');
            }
            
            return;
        }
        
        // Define available statuses
        $statuses = [
            'draft' => 'Draft - Article is being worked on',
            'published' => 'Published - Article is live and visible',
            'archived' => 'Archived - Article is no longer actively maintained',
            'pending' => 'Pending Review - Article is waiting for approval'
        ];
        
        // Display status options with clear formatting
        $this->newLine();
        $this->info('📋 <fg=bright-yellow>AVAILABLE STATUS OPTIONS</fg=bright-yellow>');
        $this->newLine();
        
        foreach ($statuses as $key => $description) {
            $color = match ($key) {
                'published' => 'bright-green',
                'draft' => 'bright-yellow',
                'archived' => 'gray',
                'pending' => 'bright-blue',
                default => 'white',
            };
            
            $this->line("<fg={$color}>[{$key}]</> {$description}");
        }
        
        $this->newLine();
        
        // Get current status of the article
        $currentStatus = $article->status ?? 'Not set';
        $this->line("<fg=bright-cyan>Current status:</> <fg=bright-white>{$currentStatus}</>");
        
        // Ask for the new status
        $newStatus = $this->anticipate('Enter the new status', array_keys($statuses), $currentStatus);
        
        // Validate the status
        if (!array_key_exists($newStatus, $statuses)) {
            $this->error('Invalid status selected.');
            return;
        }
        
        // Update the article status
        $article->status = $newStatus;
        $article->save();
        
        // Show confirmation message
        $this->newLine();
        $statusColor = match ($newStatus) {
            'published' => 'bright-green',
            'draft' => 'bright-yellow',
            'archived' => 'gray',
            'pending' => 'bright-blue',
            default => 'white',
        };
        
        $this->info('✅ <fg=bright-green>Article status updated successfully!</>');
        $this->line("<fg=bright-cyan>New status:</> <fg={$statusColor}>{$this->getStatusText($newStatus)}</>");
    }
    
    /**
     * Get human-readable status text.
     *
     * @param string|null $status
     * @return string
     */
    private function getStatusText(?string $status): string
    {
        if ($status === null) {
            return 'Unknown';
        }
        
        return match ($status) {
            'draft' => 'Draft',
            'published' => 'Published',
            'archived' => 'Archived',
            'pending' => 'Pending Review',
            default => ucfirst($status),
        };
    }
} 