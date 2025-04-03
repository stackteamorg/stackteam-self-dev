<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceChilds extends Component
{
    public $service; // Declare a property to hold the service

    /**
     * Create a new component instance.
     *
     * @param  mixed  $service
     */
    public function __construct($service)
    {
        $this->service = $service; // Assign the service to the property
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // Check if the service has children
        if ($this->service->children->isNotEmpty()) {
            return view('components.service-childs', ['service' => $this->service]); // Pass the service to the view
        }
        return ''; // Return an empty string if there are no children
    }
}
