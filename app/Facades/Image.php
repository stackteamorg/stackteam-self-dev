<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use Intervention\Image\ImageManager;

class Image extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'image';
    }
} 