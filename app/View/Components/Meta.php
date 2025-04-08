<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Meta extends Component
{

    /**
     * Create a new component instance.
     */

     protected string|null $og = null;
     protected string|null $twitter = null;
     protected string|null $article = null;

     public string|null $content = null;
     public string|null $property = null;
     public string|null $name = null;

     public function __construct(
 
         string|null $og = null,
         string|null $twitter = null,
         string|null $article = null,

         string|null $property = null,
         string|null $content = null,
         string|null $name = null,

         
         )
     {

        
         $this->og = $og;
         $this->twitter = $twitter;
         $this->article = $article;

         $this->content = $content;
         $this->property = $property;
         $this->name = $name;

         if(is_null($this->property)){

          
            $this->property = !is_null($og) ? "og:" . $og : $this->property;
            $this->property = !is_null($twitter) ? "twitter:" . $twitter : $this->property;
            $this->property = !is_null($article) ? "article:" . $article : $this->property;
         }


         
     }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (!empty($this->content)) {
            return view('components.meta');
        }

        return '';
    }
}
