<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Icon extends Component
{
    /**
     * The icon string variable.
     *
     * @var string
     */
    public string $icon;

    /**
     * Create a new component instance.
     *
     * @param string $icon
     */
    public function __construct(string $icon)
    {
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.icon');
    }
}
