<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Category;
use Illuminate\Support\Facades\App;

class ArticleCategories extends Component
{
    /**
     * The list of categories from the database.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public $categories;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Get current locale
        $locale = App::getLocale();
        
        // Fetch categories from the database for the current locale
        $this->categories = Category::where('lang', $locale)
                                ->orderBy('name')
                                ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article-categories');
    }
}
