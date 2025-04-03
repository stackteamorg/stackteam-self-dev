<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $locale = app()->getLocale();
        
        // Fetch primary services (services without parent_id)
        $primaryServices = Service::primary()
            ->byLang($locale)
            ->with(['children' => function($query) use ($locale) {
                $query->byLang($locale);
            }])
            ->get();
            
        return view('service', compact('primaryServices'));
    }

    public function show()
    {
        $locale = app()->getLocale();
        
        // Fetch the service by name and slug
        $name = request()->route('name');
        $service = Service::where('name', $name)
            ->byLang($locale)
            ->with(['children' => function($query) use ($locale) {
                $query->byLang($locale);
            }])
            ->firstOrFail();

        //dd($service->toArray());
        return view('service.show', ['service' => $service, 'article' => $service->article]);
    }
}
