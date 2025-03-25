<?php

namespace App\View\Components;

use App\Models\Image as ImageModel;
use App\Facades\Image as ImageFacade;
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
        if ($this->image && ($this->width || $this->height)) {
            $storagePath = storage_path('app/public/' . $this->image->path);
            
            if (file_exists($storagePath)) {
                $directory = dirname($storagePath);
                $filename = pathinfo($this->image->path, PATHINFO_FILENAME);
                $extension = pathinfo($this->image->path, PATHINFO_EXTENSION);
                
                $newFilename = $filename . '-' . ($this->width ?? '') . 'x' . ($this->height ?? '') . '.' . $extension;
                $newPath = $directory . '/' . $newFilename;
                
                if (!file_exists($newPath)) {
                    $image = ImageFacade::read($storagePath);
                    
                    if ($this->width && $this->height) {
                        $image->cover($this->width, $this->height);
                    } elseif ($this->width) {
                        $image->resize($this->width, null);
                    } elseif ($this->height) {
                        $image->resize(null, $this->height);
                    }
                    
                    $image->save($newPath);
                }
                
                $relativePath = str_replace(storage_path('app/public/'), '', $newPath);
                $this->image->path = $relativePath;
            }
        }

        
        return view('components.image');
    }
}
