<div class="widget widget-categories">
    <h4 class="widget-title">Categories</h4>
    <ul class="category-list list-unstyled">
        @forelse($categories as $category)
            <li><a href="{{ url(app()->getLocale() . '/blog/category/' . $category->slug) }}">{{ $category->title }}</a></li>
        @empty
            <li>No categories found</li>
        @endforelse
    </ul>
</div>