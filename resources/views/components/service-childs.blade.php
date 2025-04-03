<div class="widget widget-categories">
    <h4 class="widget-title"><x-icon src="fa-solid fa-hashtag" :width="32" :height="32" /> {{ $service->title }} </h4>
    <ul class="category-list list-unstyled">
        @foreach($service->children as $child)
        <li>
            <a href="{{ route('service.article', ['locale' => app()->getLocale(), 'name' => $child->name, 'slug' => $child->article->slug]) }}">
                <x-icon src="fa-solid fa-hashtag" :width="16" :height="16" /> {{ $child->title }}
            </a>
        </li>
        @endforeach
    </ul>
</div>