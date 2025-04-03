<?php

namespace App\Http\Controllers;

use App\Models\Technology;
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

    /**
     * Display the specified technology.
     *
     * @param string $name
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $locale = app()->getLocale();

        // Fetch the technology based on the name and language
        $technology = Technology::where('name', request()->route('name'))
            ->where('lang', $locale)
            ->firstOrFail();

        $technologySections = TechnologySection::with(['technologies' => function($query) use ($locale) {
            $query->where('lang', $locale);
        }])
        ->where('lang', $locale)
        ->get();

        //dd($technologySections->toArray());

        return view('technology.show', [
            'technology' => $technology,
            'article' => $technology->article,
            'technologySections' => $technologySections
        ]);
        
        return view('technology.show', ['technologySections' => $technologySections,'technology' => $technology, 'article' => $technology->article]);
    }


}
