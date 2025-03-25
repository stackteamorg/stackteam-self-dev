<?php

namespace App\View\Components;

use App\Models\Image as ImageModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Image extends Component
{
    /**
     * The image model instance to be displayed.
     * 
     * @var ImageModel|null
     */
    public ImageModel|null $image;

    /**
     * CSS classes to be applied to the image element.
     * 
     * @var string|null
     */
    public ?string $class;

    /**
     * Alternative text for the image.
     * 
     * @var string|null
     */
    public ?string $alt;

    /**
     * Width of the image in pixels.
     * 
     * @var int|null
     */
    public ?int $width;

    /**
     * Height of the image in pixels.
     * 
     * @var int|null
     */
    public ?int $height;

    /**
     * Whether to enable lazy loading for the image.
     * 
     * @var bool
     */
    public bool $lazy;

    /**
     * Create a new component instance.
     */
    public function __construct(ImageModel|null $image = null, ?string $class = null, ?string $alt = null, ?int $width = null, ?int $height = null) {
        
        $this->image = $image;
        $this->class = $class;
        $this->alt = $alt ?? $image?->alt_text ?? '';
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.image');
    }
}
