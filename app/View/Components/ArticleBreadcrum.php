<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Article;

class ArticleBreadcrum extends Component
{
    /**
     * The article instance.
     *
     * @var Article
     */
    public $article;

    /**
     * Create a new component instance.
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article-breadcrum');
    }
}
