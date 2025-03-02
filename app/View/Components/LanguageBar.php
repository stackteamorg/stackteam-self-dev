<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class LanguageBar extends Component
{

    public array $languages = [

        'en' => [
            'name' => 'english',
            'title' => 'English',
            'flag' => '🇬🇧',
            'url' => null,
        ],

        'fa' => [
            'name' => 'persian',
            'title' => 'فارسی',
            'flag' => '🇮🇷',
            'url' => null,
        ],

        'ar' => [
            'name' => 'persian',
            'title' => 'العربية',
            'flag' => '🇦🇪',
            'url' => null,
        ],
    ];

    public array $current = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }
    

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $route = $route = Route::current();
        $parameters = $route->parameters();

        $this->current = $this->languages[$parameters['locale']];
        
        foreach ($this->languages as $locate => $lang) {

            $parameters['locale'] = $locate; // Change the locale
            $this->languages[$locate]['url'] = route($route->getName(), $parameters);
        }
            
        return view('components.language-bar');
    }
}
