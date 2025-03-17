<div class="single-blog-content blog-grid">
    @if($article->icon)
    <div class="post-thumbnail">
        <img src="{{ asset($article->icon) }}" alt="{{ $article->title }}">
    </div>
    @endif
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
    
    @auth
        @if(auth()->user()->id === $article->author_id)
        <div class="article-actions mb-4 text-end">
            <a href="#" id="edit-article-button" class="axil-btn btn-outline-primary btn-sm">
                <i class="fa-solid fa-pen-to-square"></i>
            </a>
            <a href="#" id="save-article-button" class="axil-btn btn-primary btn-sm" style="display: none;" 
               data-article-id="{{ $article->id }}" 
               data-save-url="{{ route('articles.update', $article->id) }}">
                ذخیره تغییرات
            </a>
        </div>
        @endif
    @endauth
    
    <div class="content">
        <div id="editorjs-container" 
             data-content="{{ $article->content }}"
             data-fallback-content="{{ $article->content }}">
        </div>
    </div>


</div>