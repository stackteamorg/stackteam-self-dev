@if ($paginator->hasPages())
    <ul>
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li><a class="prev page-numbers disabled"><i class="fal fa-arrow-right"></i></a></li>
        @else
            <li><a class="prev page-numbers" href="{{ $paginator->previousPageUrl() }}"><i class="fal fa-arrow-right"></i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><a class="page-numbers disabled" href="#">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li><a href="#" class="page-numbers current">{{ $page }}</a></li>
                    @else
                        <li><a class="page-numbers" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a class="next page-numbers" href="{{ $paginator->nextPageUrl() }}"><i class="fal fa-arrow-left"></i></a></li>
        @else
            <li><a class="next page-numbers disabled"><i class="fal fa-arrow-left"></i></a></li>
        @endif
    </ul>
@endif 