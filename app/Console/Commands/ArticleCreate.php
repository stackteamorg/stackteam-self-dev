<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Article;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Validator as ValidatorInstance;

class ArticleCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:article';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new article using Artisan CLI';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $articleData = $this->collectArticleData();
        
        if ($this->isDataInvalid($articleData)) {
            return 1; // Command failed
        }
        
        $article = $this->createArticle($articleData);
        $this->displaySuccessMessage($article);
        
        return 0; // Command succeeded
    }

    /**
     * Collect all necessary data for article creation.
     *
     * @return array
     */
    private function collectArticleData(): array
    {
        
        $title = $this->ask('Enter article title');

        // Set the language of the article
        $lang = $this->choice('Select article language', ['fa', 'en', 'ar'], 0);
        App::setlocale($lang);

        $slug = $this->createSlug($title);

        $data = [
            'title' => $title,
            'content' => $this->ask('Enter article content', Lang::get('taas.loren')),
            'lang' => $lang,
            'slug' => $slug,
            'author_id' => $this->getAuthorId(),
            'category_id' => $this->getCategoryId(),
        ];
        
        return $data;
    }

    /**
     * ایجاد اسلاگ با جایگزینی فضای خالی با خط تیره
     *
     * @param string $title
     * @return string
     */
    private function createSlug(string $title): string
    {
        // حذف کاراکترهای غیر مجاز و جایگزینی با خط تیره
        $slug = preg_replace('/[^\p{L}\p{N}]+/u', '-', $title);
        
        // حذف خط تیره‌های اضافی از ابتدا و انتهای رشته
        $slug = trim($slug, '-');
        
        // اگر اسلاگ خالی شد، یک مقدار پیش‌فرض برگردان
        if (empty($slug)) {
            return 'untitled';
        }
        
        return $slug;
    }

    /**
     * Get the author ID from user selection.
     *
     * @return int|null
     */
    private function getAuthorId(): ?int
    {
        return $this->getEntityId(User::class, 'author');
    }

    /**
     * Get the category ID from user selection.
     *
     * @return int|null
     */
    private function getCategoryId(): ?int
    {
        return $this->getEntityId(Category::class, 'category');
    }

    /**
     * Generic method to get entity ID from user selection.
     *
     * @param string $modelClass
     * @param string $entityName
     * @return int|null
     */
    private function getEntityId(string $modelClass, string $entityName): ?int
    {
        $entities = $modelClass::all();
        
        if ($entities->isEmpty()) {
            $this->warn("No {$entityName}s found. The {$entityName} will be set to null.");
            return null;
        }
        
        $choices = $entities->pluck('name', 'id')->toArray();
        $selectedName = $this->choice("Select the {$entityName}", $choices);
        
        return array_search($selectedName, $choices);
    }

    /**
     * Check if the provided data is invalid.
     *
     * @param array $data
     * @return bool
     */
    private function isDataInvalid(array $data): bool
    {
        $validator = $this->validateData($data);

        if ($validator->fails()) {
            $this->displayValidationErrors($validator);
            return true;
        }

        return false;
    }

    /**
     * Validate the article data.
     *
     * @param array $data
     * @return ValidatorInstance
     */
    private function validateData(array $data): ValidatorInstance
    {
        return Validator::make($data, [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:articles,slug',
            'content' => 'required|string',
            'lang' => 'required|string|in:fa,en,ar',
        ]);
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
     * Create a new article with the provided data.
     *
     * @param array $data
     * @return Article
     */
    private function createArticle(array $data): Article
    {
        return Article::create([
            'title' => $data['title'],
            'slug' => $data['slug'],
            'content' => $data['content'],
            'author_id' => $data['author_id'],
            'category_id' => $data['category_id'],
            'lang' => $data['lang'],
        ]);
    }

    /**
     * Display success message after article creation.
     *
     * @param Article $article
     * @return void
     */
    private function displaySuccessMessage(Article $article): void
    {
        $this->info('Article created successfully!');
        $this->info('Title: ' . $article->title);
        $this->info('Article ID: ' . $article->id);
    }
}
