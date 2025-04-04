<?php

namespace App\View\Components;

use App\Models\Service;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceSection extends Component
{
    /**
     * Create a new component instance.
     */

    public $primaryServices;
    
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $locale = app()->getLocale();
        
        // Fetch primary services (services without parent_id)
        $this->primaryServices = Service::primary()
            ->byLang($locale)
            ->with(['children' => function($query) use ($locale) {
                $query->byLang($locale);
            }])
            ->get();

        return view('components.service-section');
    }
}
