<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\View\Component;

class StyleLayout extends Component
{
    private string $template = 'abstrak';
    private string $locate = 'en';
    
    /**
     * Create a new component instance.
     */

    protected array $rtlFiles = [

        'css/vendor/bootstrap.min.css' => 'css/vendor/bootstrap.rtl.min.css',
        'css/app.css' => 'css/app-rtl.css'
    ];

    public function __construct(string|null $style=null)
    {
        $this->locate = App::getLocale();
        $this->path = $style;

        if ($style == 'font-lang') {
            $this->path = in_array( $this->locate,['fa','ar','ru']) ? 'css/fonts/language-fonts/' . $this->locate . '.css' : null;
        }


    }

    /**
     * Get the view / contents that represent the component.
     */
    public string|null $path = null;

    public function render(): View|Closure|string
    {
        
        if (is_null($this->path)) {
            return '';
        }

        if (in_array($this->locate,['fa','ar','syc']) && isset($this->rtlFiles[$this->path])) {
            $this->path = $this->rtlFiles[$this->path];
        }

        $this->path = "$this->template/$this->path";

        return view('components.style-layout');
    }
}
