<div class="widget widget-recent-post">
    <h4 class="widget-title h5"><i class="fa-duotone fa-solid fa-hashtag"></i> آخرین مقالات{{ $category ? ' in ' . $category->title : '' }}</h4>
    <div class="post-list-wrap">
        @forelse ($articles as $article)
            <div class="single-post">
                @if($article->image)
                <div class="post-thumbnail">
                    <a href="{{ route('blog.article', ['locale' => app()->getLocale(), 'slug' => $article->slug, 'id' => $article->id]) }}">
                        <x-image :image="$article->image" width="100" height="80" />
                    </a>
                </div>
                @endif
                <div class="post-content">
                    <h6 class="title h6">
                        <a href="{{ route('blog.article', ['locale' => app()->getLocale(), 'slug' => $article->slug, 'id' => $article->id]) }}">{{ $article->title }}</a>
                    </h6>
                    <ul class="blog-meta list-unstyled">
                        <li>{{ $article->created_at->format('d F Y') }}</li>
                        <li>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} min read</li>
                    </ul>
                </div>
            </div>
        @empty
            <div class="single-post">
                <div class="post-content">
                    <h6 class="title">هیچ مقاله ای موجود نیست</h6>
                </div>
            </div>
        @endforelse
    </div>
</div>