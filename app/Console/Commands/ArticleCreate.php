<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ArticleService;
use Illuminate\Support\Facades\Validator;

class ArticleCreate extends Command
{

    protected $signature = 'article:create'; // Define the Artisan command signature
    protected $description = 'Create a new article using Artisan CLI'; // Description of the command
    protected $articleService;

    public function __construct(ArticleService $articleService)
    {
        parent::__construct();
        $this->articleService = $articleService;
    }

    /**
     * Execute the console command.
     */

    public function handle(ArticleService $articleService)
    {
         // Prompt user input for article details
         $data = [
            'title'       => $this->ask('Enter article title'), // Get the title from the user
            'slug'        => $this->ask('Enter article slug'), // Get the slug from the user
            'content'     => $this->ask('Enter article content'), // Get the content from the user
            'author_id'   => $this->ask('Enter author ID'), // Get the author ID (optional)
            'category_id' => $this->ask('Enter category ID'), // Get the category ID (optional)
            'lang'        => $this->choice('Select article language', ['fa', 'en', 'ar'], 0), // Allow user to choose a language from predefined options
            'tags'        => explode(',', $this->ask('Enter tag IDs separated by commas (e.g., 1,2,3)')), // Get comma-separated tag IDs and convert to an array
        ];

        // Validate user input
        $validator = Validator::make($data, [
            'title'       => 'required|string|max:255', // Title is required and must be a string with max length of 255
            'slug'        => 'required|string|unique:articles,slug', // Slug is required and must be unique in the articles table
            'content'     => 'required|string', // Content is required and must be a string
            'author_id'   => 'nullable|exists:users,id', // Author ID must exist in users table if provided
            'category_id' => 'nullable|exists:categories,id', // Category ID must exist in categories table if provided
            'lang'        => 'required|string|in:fa,en,ar', // Language must be one of the predefined options
            'tags'        => 'array', // Tags must be an array
            'tags.*'      => 'exists:tags,id', // Each tag ID must exist in the tags table
        ]);

        // If validation fails, show error messages and stop execution
        if ($validator->fails()) {
            $this->error('Validation failed:');
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return;
        }

        // Create the article using the ArticleService
        $article = $this->articleService->createArticle($data);

        // Display success message and article details
        $this->info('Article created successfully!');
        $this->info('Title: ' . $article->title);
        $this->info('Article ID: ' . $article->id);
        
    }
}
