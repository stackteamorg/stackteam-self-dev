<?php
namespace App\Services;

use App\Models\{Article, Category, Tag};
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArticleService
{
    // Create a new Article  
    public function createArticle(array $data)
    {
        return DB::transaction(function () use ($data) {
            $article = Article::create($data);
            
            if (isset($data['tags'])) {
                $article->tags()->sync($data['tags']);
            }
            
            return $article;
        });
    }

    // Update Article
    public function updateArticle(int $id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {
            $article = Article::findOrFail($id);
            $article->update($data);

            if (isset($data['tags'])) {
                $article->tags()->sync($data['tags']);
            }
            
            return $article;
        });
    }

    // حذف مقاله
    public function deleteArticle(int $id)
    {
        $article = Article::findOrFail($id);
        return $article->delete();
    }

    // افزودن دسته‌بندی جدید
    public function createCategory(array $data)
    {
        return Category::create($data);
    }

    // افزودن تگ جدید
    public function createTag(array $data)
    {
        return Tag::create($data);
    }

    // اساین کردن دسته‌بندی به مقاله
    public function assignCategory(int $articleId, int $categoryId)
    {
        $article = Article::findOrFail($articleId);
        $category = Category::findOrFail($categoryId);
        
        $article->category()->associate($category);
        return $article->save();
    }

    // اساین کردن تگ‌ها به مقاله
    public function assignTags(int $articleId, array $tagIds)
    {
        $article = Article::findOrFail($articleId);
        $article->tags()->sync($tagIds);
        return $article;
    }

    // دریافت جدیدترین مقالات
    public function getLatestArticles(int $limit = 10)
    {
        return Article::latest()->take($limit)->get();
    }
}
