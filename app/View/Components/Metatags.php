<?php

namespace App\View\Components;

use App\Services\Metatag;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Metatags extends Component
{
    /**
     * Create a new component instance.
     */

    // Properties for the Metatags component
    public string|null $title = null;   
    public string|null $description = null;
    public string|null $author = null;
    public string|null $locale = 'fa'; // Default locale set to Persian
    public string|null $type = 'website'; // Default type set to website
    public string|null $url = null;
    public string|null $image = null;
    public string|null $published_time = null;
    public string|null $modified_time = null;

    // Constructor to initialize the Metatags component with Metatag service
    public function __construct(Metatag $metatag)
    {
        // Assigning values from the Metatag service to the component properties
        $this->title = $metatag->title;
        $this->description = $metatag->description;
        $this->author = $metatag->author;
        $this->locale = $metatag->locale;
        $this->type = $metatag->type;
        $this->url = $metatag->url; 
        $this->image = $metatag->image;
        $this->published_time = $metatag->published_time;
        $this->modified_time = $metatag->modified_time; 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.metatags');
    }
}
