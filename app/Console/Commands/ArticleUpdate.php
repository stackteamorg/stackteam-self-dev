<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Validator as ValidatorInstance;

class ArticleUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:article {id? : The ID of the article to update}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the content of an existing article';

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
        
        $this->displayArticleInfo($article);
        
        if (!$this->confirm('Do you want to update this article?', true)) {
            $this->info('Update canceled.');
            return 0;
        }
        
        $data = $this->collectUpdateData($article);
        
        if ($this->isDataInvalid($data)) {
            return 1; // Command failed
        }
        
        $this->updateArticle($article, $data);
        $this->displaySuccessMessage($article);
        
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
        
        return $this->ask('Enter the ID of the article you want to update');
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
     * Display information about the selected article.
     *
     * @param Article $article
     * @return void
     */
    private function displayArticleInfo(Article $article): void
    {
        $this->newLine();
        $this->info('📋 <fg=bright-yellow;bg=blue>ARTICLE DETAILS</fg=bright-yellow;bg=blue>');
        $this->newLine();
        
        // Main article information with colors
        $this->line("<fg=bright-cyan>ID:</> <fg=bright-white>{$article->id}</>");
        $this->line("<fg=bright-cyan>Title:</> <fg=bright-white>{$article->title}</>");
        $this->line("<fg=bright-cyan>Language:</> <fg=bright-white>{$article->lang}</>");
        
        // Relationships
        $authorName = $article->author ? $article->author->name : 'None';
        $authorColor = $article->author ? 'bright-green' : 'bright-red';
        $this->line("<fg=bright-cyan>Author:</> <fg={$authorColor}>{$authorName}</>");
        
        $categoryName = $article->category ? $article->category->name : 'None';
        $categoryColor = $article->category ? 'bright-green' : 'bright-red';
        $this->line("<fg=bright-cyan>Category:</> <fg={$categoryColor}>{$categoryName}</>");
        
        // Content preview
        $contentPreview = substr($article->content, 0, 100) . (strlen($article->content) > 100 ? '...' : '');
        $this->line("<fg=bright-cyan>Content Preview:</> <fg=bright-white>{$contentPreview}</>");
        
        // Article URL
        $articleUrl = route('blog.article', ['locale' => $article->lang, 'id' => $article->id, 'slug' => $article->slug]);
        $this->line("<fg=bright-cyan>URL:</> <fg=bright-green>{$articleUrl}</>");
        
        $this->newLine();
    }

    /**
     * Collect data for the article update.
     *
     * @param Article $article
     * @return array
     */
    private function collectUpdateData(Article $article): array
    {
        $data = [];
        
        if ($this->confirm('Do you want to update the title?', false)) {
            $data['title'] = $this->ask('Enter new title', $article->title);
        }
        
        if ($this->confirm('Do you want to update the content?', true)) {

            $editorContent = $this->runEditor($article->content, $article->id);
            $editorContent !== null ? $data['content'] = $editorContent : null;
        }
        
        return $data;
    }

    private function runEditor(string|null $content = null, int|null $id = null): string|null
    {
        // Determine file name based on id
        $fileName = $id === null ? 'article-draft' : 'articles-' . $id;
        $filePath = '~/' . $fileName . '.md';
        $expandedPath = str_replace('~', $_SERVER['HOME'], $filePath);
        $fileContent = null;
        
        // If content is provided, save it to the file before opening
        if ($content !== null) {
            // Create directory if it doesn't exist
            $directory = dirname($expandedPath);
            if (!is_dir($directory)) {
                mkdir($directory, 0755, true);
            }
            
            // Save content to file
            file_put_contents($expandedPath, $content);
            $this->info("Content saved to file: {$filePath}");
        }
        
        // Execute the Typora command to open the file
        $command = "typora $filePath";
        $this->info("Executing: {$command}");
        
        // Execute the command
        $returnCode = 0;
        exec($command, $output, $returnCode);
        exec('clear', $output, $returnCode);

        if ($returnCode !== 0) {
            $this->error("Failed to execute Typora command. Return code: {$returnCode}");
            return null;
        }
        
        $this->info("Terminal screen cleared.");
        
        // Read and display the content of the file
        if (file_exists($expandedPath)) {
            $fileContent = file_get_contents($expandedPath);
            $this->info("Reading content from md file:");
        } else {
            $this->warn("File not found: {$expandedPath}");
        }

        return $fileContent;
    }

    /**
     * Check if the provided data is invalid.
     *
     * @param array $data
     * @return bool
     */
    private function isDataInvalid(array $data): bool
    {
        if (empty($data)) {
            $this->error('No data provided for update.');
            return true;
        }
        
        $validator = $this->validateData($data);

        if ($validator->fails()) {
            $this->displayValidationErrors($validator);
            return true;
        }

        return false;
    }

    /**
     * Validate the article update data.
     *
     * @param array $data
     * @return ValidatorInstance
     */
    private function validateData(array $data): ValidatorInstance
    {
        $rules = [];
        
        if (isset($data['title'])) {
            $rules['title'] = 'required|string|max:255';
        }
        
        if (isset($data['content'])) {
            $rules['content'] = 'required|string';
        }
        
        return Validator::make($data, $rules);
    }

    /**
     * Display validation errors.
     *
     * @param ValidatorInstance $validator
     * @return void
     */
    private function displayValidationErrors(ValidatorInstance $validator): void
    {
        $this->error('Validation failed:');
        
        foreach ($validator->errors()->all() as $error) {
            $this->error("- {$error}");
        }
    }

    /**
     * Update the article with the provided data.
     *
     * @param Article $article
     * @param array $data
     * @return void
     */
    private function updateArticle(Article $article, array $data): void
    {
        $article->update($data);
    }

    /**
     * Display success message after article update.
     *
     * @param Article $article
     * @return void
     */
    private function displaySuccessMessage(Article $article): void
    {
        $this->info('Article has been updated successfully!');
        $this->line("ID: {$article->id}");
        $this->line("Title: {$article->title}");
        
        $this->line("Content (first 100 chars): " . substr($article->content, 0, 100) . (strlen($article->content) > 100 ? '...' : ''));
    }
} 