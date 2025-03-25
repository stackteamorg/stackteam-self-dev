<div class="widget widget-recent-post">
    <h4 class="widget-title">Recent Posts{{ $category ? ' in ' . $category->title : '' }}</h4>
    <div class="post-list-wrap">
        @forelse ($articles as $article)
            <div class="single-post">
                <div class="post-thumbnail">
                    <a href="{{ url(app()->getLocale() . '/blog/' . $article->slug) }}">
                        <img src="{{ $article->thumbnail ? asset($article->thumbnail) : asset('abstrak/media/blog/blog-default.png') }}" alt="{{ $article->title }}">
                    </a>
                </div>
                <div class="post-content">
                    <h6 class="title">
                        <a href="{{ url(app()->getLocale() . '/blog/' . $article->slug) }}">{{ $article->title }}</a>
                    </h6>
                    <ul class="blog-meta list-unstyled">
                        <li>{{ $article->created_at->format('d/m/Y') }}</li>
                        <li>{{ $article->reading_time ?? '5' }} min read</li>
                    </ul>
                </div>
            </div>
        @empty
            <div class="single-post">
                <div class="post-content">
                    <h6 class="title">No articles found</h6>
                </div>
            </div>
        @endforelse
    </div>
</div>