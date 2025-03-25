<div class="single-blog-content blog-grid">

    <div class="post-thumbnail">
        <img src="{{ $article->image ? asset('storage/' . $article->image) : asset('abstrak/media/blog/blog-3.png') }}" alt="{{ $article->title }}" id="article-image">
    </div>
    
    <div class="author">
        <div class="author-thumb">
            @if($article->author && $article->author->profile_photo_path)
            <img src="{{ asset($article->author->profile_photo_path) }}" alt="{{ $article->author->name }}">
            @else
            <img src="{{ asset('abstrak/media/blog/author-1.png') }}" alt="Blog Author">
            @endif
        </div>
        <div class="info">
            <h6 class="author-name">{{ $article->author ? $article->author->name : 'نویسنده ناشناس' }}</h6>
            <ul class="blog-meta list-unstyled">
                <li>{{ $article->created_at->format('Y/m/d') }}</li>
                <li>{{ ceil(str_word_count($article->content) / 200) }} دقیقه برای خواندن</li>
            </ul>
        </div>
    </div>
    
    
    <div class="content">
        {!! $content !!}    
        <div class="breadcrumb">
            <ul class="list-unstyled">
                                
                @if($article->tags && $article->tags->count() > 0)
                    @foreach($article->tags as $tag)
                        <li class="active">
                            <i class="fa-solid fa-tag"></i> {{ $tag->name }}
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>


</div>