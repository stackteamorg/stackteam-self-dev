@props(['image', 'class' => null, 'alt' => null, 'width' => null, 'height' => null, 'lazy' => true])

<img 
    @if($image) src="{{ asset('storage/' . $image->path) }}" @endif
    @if($class) class="{{ $class }}" @endif
    @if($alt) alt="{{ $alt }}" @endif
    @if($width) width="{{ $width }}" @endif
    @if($height) height="{{ $height }}" @endif
>