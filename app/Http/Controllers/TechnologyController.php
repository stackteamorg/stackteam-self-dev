<?php

namespace App\Http\Controllers;

use App\Models\TechnologySection;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display the technology page
     */
    public function __invoke()
    {
        $locale = app()->getLocale();
        
        // Fetch all technology sections with their technologies
        $technologySections = TechnologySection::with(['technologies' => function($query) use ($locale) {
            $query->where('lang', $locale);
        }])
        ->where('lang', $locale)
        ->get();
        
        //dd($technologySections->toArray());
        return view('technology', compact('technologySections'));
    }
}
