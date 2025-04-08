<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Services\Metatag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

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

    public function show(Metatag $metatag)
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


        $metatag->setTitle(Lang::get('metatags.public.site_name') . ' | ' . $service->article->title);
        $metatag->setDescription($service->article->description);
        $metatag->setAuthor($service->article->author->name);
        $metatag->setType('article');
        
        //dd($service->toArray());
        return view('service.show', ['service' => $service, 'article' => $service->article]);
    }
}
