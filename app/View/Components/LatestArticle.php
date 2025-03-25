<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\App;

class LatestArticle extends Component
{
    /**
     * The list of latest articles from the specified category.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public $articles;

    /**
     * The category from which to fetch the latest articles.
     *
     * @var \App\Models\Category|null
     */
    public $category;

    /**
     * Create a new component instance.
     * 
     * @param \App\Models\Category|null $category The category to fetch articles from
     */
    public function __construct($category = null)
    {
        $this->category = $category;
        $locale = App::getLocale();
        
        // Query to get latest articles
        $query = Article::where('lang', $locale)
                      ->where('status', 'published')
                      ->orderBy('created_at', 'desc');
        
        // If a specific category is provided, filter by that category
        if ($this->category) {
            $query->where('category_id', $this->category->id);
        }
        
        // Get latest articles, limit to 5
        $this->articles = $query->limit(5)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.latest-article');
    }
}
