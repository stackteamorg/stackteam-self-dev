@foreach($technologySections as $section)
<div class="widget widget-categories">
    <h4 class="widget-title h5"><i class="fa-solid fa-hashtag"></i> {{ $section->title }}</h4>
    <ul class="category-list list-unstyled">
        @foreach($section->technologies as $technology)
            @if($technology->article)
            <li>
                <a href="{{ route('technology.article', ['name' => $technology->name, 'locale' => app()->getLocale(), 'slug' => $technology->article->slug]) }}">
                    <x-icon src="fa-solid fa-hashtag" :width="16" :height="16" /> {{ $technology->title }}
                </a>
            </li>
            @else
            <li>
                <a href="#">
                    <x-icon src="fa-solid fa-hashtag" :width="16" :height="16" /> {{ $technology->title }}
                </a>
            </li>
            @endif
        @endforeach
    </ul>
</div>
@endforeach