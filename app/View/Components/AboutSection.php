<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AboutSection extends Component
{
    /**
     * Create a new component instance.
     *
     * @param bool $heading
     */

    public bool $heading;

    public function __construct(bool $heading = false)
    {
        $this->heading = $heading;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.about-section');
    }
}