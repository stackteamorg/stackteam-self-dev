<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ArticleCreate extends Command
{

    protected $signature = 'make:article'; // Define the Artisan command signature
    protected $description = 'Create a new article using Artisan CLI'; // Description of the command


    /**
     * Execute the console command.
     */

    public function handle()
    {
        $data = $this->getArticleData();
        $authorId = $this->getAuthorId();
        $categoryId = $this->getCategoryId();

        $validator = $this->validateData($data);

        if ($validator->fails()) {
            $this->displayValidationErrors($validator);
            return;
        }

        $article = $this->createArticle($data, $authorId, $categoryId);

        $this->displaySuccessMessage($article);
    }

    private function getArticleData()
    {
        return [
            'title' => $this->ask('Enter article title'),
            'content' => $this->ask('Enter article content', Lang::get('taas.loren')),
            'lang' => $this->choice('Select article language', ['fa', 'en', 'ar'], 0),
            'slug' => Str::slug($this->ask('Enter article title')),
        ];
    }

    private function getAuthorId()
    {
        $authors = User::all();
        $authorChoices = $authors->pluck('name', 'id')->toArray();
        $authorName = $this->choice('Select the author', $authorChoices);
        return array_search($authorName, $authorChoices);
    }

    private function getCategoryId()
    {
        $categories = Category::all();
        $categoryChoices = $categories->pluck('name', 'id')->toArray();
        $categoryName = $this->choice('Select the category', $categoryChoices);
        return array_search($categoryName, $categoryChoices);
    }

    private function validateData($data)
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:articles,slug',
            'content' => 'required|string',
            'lang' => 'required|string|in:fa,en,ar',
        ]);
    }

    private function displayValidationErrors($validator)
    {
        $this->error('Validation failed:');
        foreach ($validator->errors()->all() as $error) {
            $this->error($error);
        }
    }

    private function createArticle($data, $authorId, $categoryId)
    {
        return Article::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'author_id' => $authorId,
            'category_id' => $categoryId,
            'lang' => $data['lang'],
        ]);
    }

    private function displaySuccessMessage($article)
    {
        $this->info('Article created successfully!');
        $this->info('Title: ' . $article->title);
        $this->info('Article ID: ' . $article->id);
    }
}
