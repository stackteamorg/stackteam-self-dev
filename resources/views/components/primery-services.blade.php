<div class="widget widget-categories">
    <h4 class="widget-title"><x-icon src="fa-duotone fa-solid fa-hashtag" :width="32" :height="32" /> خدمات استک تیم</h4>
    <ul class="category-list list-unstyled">
        @foreach($primaryServices as $service)
        <li>
            <a href="{{ $service->article ? route('service.article', ['locale' => app()->getLocale(), 'name' => $service->name, 'slug' => $service->article->slug]) : '#' }}">
                <x-icon src="fa-duotone fa-solid fa-hashtag" :width="16" :height="16" /> {{ $service->title }}
            </a>
        </li>
        @endforeach
    </ul>
</div>