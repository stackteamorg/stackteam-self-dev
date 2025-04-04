<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Str;

class ArticleShortContent extends Component
{
    public $content;

    /**
     * Create a new component instance.
     *
     * @param string $content
     * @param int|null $limit
     */
    public function __construct(string $content, int $limit = 200)
    {
        $this->content = Str::limit(strip_tags(Str::markdown($content)), $limit);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article-short-content');
    }
}
