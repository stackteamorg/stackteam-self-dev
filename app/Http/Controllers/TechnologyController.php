<?php

namespace App\Http\Controllers;

use App\Models\TechnologySection;
use Illuminate\Http\Request;

class TechnologyController extends Controller
{
    /**
     * Display the technology page
     */
    public function index()
    {
        $locale = app()->getLocale();
        
        // Fetch all technology sections with their technologies
        $technologySections = TechnologySection::with(['technologies' => function($query) use ($locale) {
            $query->where('lang', $locale);
        }])
        ->where('lang', $locale)
        ->get();
        
        return view('technology', compact('technologySections'));
    }
}
