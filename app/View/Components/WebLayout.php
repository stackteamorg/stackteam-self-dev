<?php

namespace App\View\Components;

use Illuminate\Support\Facades\App;
use Illuminate\View\Component;
use Illuminate\View\View;

class WebLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */

    public bool $isRtl = false;
    public string $locate = 'en';
    public string|null $fontLocate = null;

    public function render(): View
    {
        $this->locate = App::getLocale();
        $this->isRtl = in_array($this->locate,['fa','ar','syc']);

        if (in_array($this->locate,['fa','ar','ru'])) {
            $this->fontLocate = asset('abstrak/css/fonts/language-fonts/' . $this->locate . '.css');
        }
        
        return view('layouts.web');
    }
}
