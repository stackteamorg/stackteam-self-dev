<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProcessSection extends Component
{
    public $steps;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->steps = trans('process.steps'); // Reading the process list from the Lang file
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.process-section');
    }
}
