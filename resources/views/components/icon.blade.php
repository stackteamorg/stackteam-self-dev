@if ($isSVG)
    <img src="{{ asset($src) }}" width="{{ $width }}" height="{{ $height }}" alt="{{ $alt }}">
@else
    <i class="{{ $src }}" style="font-size: {{ $width }}px;"></i>
@endif
