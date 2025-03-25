<div class="single-blog-content blog-grid">

    <div class="post-thumbnail">
        <x-image :image="$article->image" />
    </div>
    
    <div class="author">
        <div class="author-thumb">
            <x-image :image="$article->author->profileImage" width="64" height="64" />  
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