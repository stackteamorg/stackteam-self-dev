<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\User;

class ArticleAuthor extends Component
{
    /**
     * The author instance.
     *
     * @var User
     */
    public $author;

    /**
     * Create a new component instance.
     */
    public function __construct(User $author)
    {
        $this->author = $author;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.article-author');
    }
}
