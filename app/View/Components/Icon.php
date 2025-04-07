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
    public string|null $src = null;

    public string $alt;

    public int $width;

    public int $height;

    protected string $filePath;

    /**
     * The SVG icon string variable.
     *
     * @var string
     */
    public bool $isSVG = false;


    /**
     * Create a new component instance.
     *
     * @param string $icon
     */
    public function __construct(string|null $src, int $width = 64, int $height = 64, string $alt = '')
    {
        $this->filePath = public_path('/svgs/' . $src);

        $this->src = $src;
        $this->isSVG = file_exists($this->filePath) && (pathinfo($this->filePath, PATHINFO_EXTENSION) === 'svg');

        if ($this->isSVG) {
            $this->src = '/svgs/' . $src;
        }

        //die($this->isSVG . '--');
        $this->width = $width;
        $this->height = $height;

        $this->alt = $alt;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (is_null($this->src)) {
            return '';
        }

        return view('components.icon');
    }


}
