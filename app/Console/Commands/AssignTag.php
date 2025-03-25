<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use App\Models\Tag;
use App\Models\ArticleTag;

class AssignTag extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assign:tag {--article_id= : The ID of the article to assign tags to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assign a tag to an article';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get article ID from command option or ask for it
        $articleId = $this->option('article_id');
        
        if (!$articleId) {
            $articleId = $this->ask('Enter article ID');
        }
        
        // Find the article
        $article = Article::find($articleId);
        
        if (!$article) {
            $this->error("Article with ID {$articleId} not found.");
            return 1;
        }
        
        $this->info("Selected article: '{$article->title}'");
        
        // Get all available tags (without lang filtering)
        $tags = Tag::all();
        
        if ($tags->isEmpty()) {
            $this->error("No tags found in the database.");
            return 1;
        }
        
        // Display available tags
        $this->info('Available tags:');
        $tagChoices = $tags->pluck('name', 'id')->toArray();
        
        // Show current tags assigned to the article
        $currentTags = $article->tags->pluck('name')->toArray();
        if (count($currentTags) > 0) {
            $this->info('Current tags: ' . implode(', ', $currentTags));
        } else {
            $this->info('No tags currently assigned to this article.');
        }
        
        // Ask user to select a tag
        $selectedTagId = $this->choice(
            'Select a tag to assign to the article',
            $tagChoices
        );
        
        // Get the ID of the selected tag
        $selectedTagId = array_search($selectedTagId, $tagChoices);
        
        // Check if the tag is already assigned
        if ($article->tags->contains($selectedTagId)) {
            $this->warn('This tag is already assigned to the article.');
            return 0;
        }
        
        // Assign the tag to the article using the relationship
        try {
            // Using the relationship is cleaner and handles the pivot table automatically
            $article->tags()->attach($selectedTagId);
            
            $selectedTag = Tag::find($selectedTagId);
            $this->info("Tag '{$selectedTag->name}' has been successfully assigned to article '{$article->title}'.");
            
            return 0;
        } catch (\Exception $e) {
            $this->error('Failed to assign tag: ' . $e->getMessage());
            return 1;
        }
    }
}
