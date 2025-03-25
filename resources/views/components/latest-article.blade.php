<div class="widget widget-recent-post">
    <h4 class="widget-title">Recent Posts{{ $category ? ' in ' . $category->title : '' }}</h4>
    <div class="post-list-wrap">
        @forelse ($articles as $article)
            <div class="single-post">
                <div class="post-thumbnail">
                    <a href="{{ route('blog.article', ['locale' => app()->getLocale(), 'slug' => $article->slug, 'id' => $article->id]) }}">
                        <x-image :image="$article->image" width="100" height="80" />
                    </a>
                </div>
                <div class="post-content">
                    <h6 class="title">
                        <a href="{{ route('blog.article', ['locale' => app()->getLocale(), 'slug' => $article->slug, 'id' => $article->id]) }}">{{ $article->title }}</a>
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