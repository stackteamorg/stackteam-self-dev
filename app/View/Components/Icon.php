<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Icon extends Component
{
    /**
     * The icon string variable.
     *
     * @var string
     */
    public string $src;

    public int $width;

    public int $height;

    protected string $filePath;
    /**
     * The SVG icon string variable.
     *
     * @var string
     */
    public bool $isSVG = false;

    // The SVG string representation of the icon.
    protected string $svg = '';

    // Function to set the dimensions of the SVG icon.
    private function setSvgDimensions(int $width, int $height): string
    {
        $this->svg = preg_replace('/(width|height)="\d+px"/', '$1="' . $width . 'px"', $this->svg);
        $this->svg = preg_replace('/viewBox="0 0 \d+ \d+"/', 'viewBox="0 0 ' . $width . ' ' . $height . '"', $this->svg);
    
        return $this->svg;
    }

    /**
     * Create a new component instance.
     *
     * @param string $icon
     */
    public function __construct(string $src, int $width = 64, int $height = 64)
    {
        $this->filePath = public_path('/svgs/' . $src);

        $this->src = $src;
        $this->isSVG = pathinfo($this->filePath, PATHINFO_EXTENSION) === 'svg';
        //die($this->isSVG . '--');
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if ($this->isSVG) {
            
            if (file_exists($this->filePath)) {
                $this->svg = file_get_contents($this->filePath);
                return $this->setSvgDimensions($this->width, $this->height); 
            }

            return ''; // Return empty string if file does not exist
        }
        return view('components.icon');
    }


}
