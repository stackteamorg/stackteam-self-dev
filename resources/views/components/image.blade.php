@props(['image', 'class' => null, 'alt' => null, 'width' => null, 'height' => null, 'lazy' => true])

<img 
    src="{{ $image->full_path }}"
    @if($lazy) loading="lazy" @endif
    @if($class) class="{{ $class }}" @endif
    @if($alt) alt="{{ $alt }}" @endif
    @if($width) width="{{ $width }}" @endif
    @if($height) height="{{ $height }}" @endif
>