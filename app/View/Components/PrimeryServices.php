<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Service; // Import the Service model

class PrimeryServices extends Component
{
    public $primaryServices; // Declare a property to hold the services

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Fetch the list of primary services

        $locale = app()->getLocale();
        
        // Fetch primary services (services without parent_id)
        $this->primaryServices = Service::primary()
            ->byLang($locale)
            ->with(['children' => function($query) use ($locale) {
                $query->byLang($locale);
            }])
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.primery-services'); // Pass the services to the view
    }
}
