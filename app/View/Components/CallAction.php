<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CallAction extends Component
{
    /**
     * Create a new component instance.
     */

    public $buttonText;
    public $id;
    public function __construct(string $buttonText, string $id='')
    {
        $this->buttonText = $buttonText;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.call-action');
    }
}
