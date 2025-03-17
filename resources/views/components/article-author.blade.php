<div class="blog-author">
    <div class="author">
        <div class="author-thumb">
            @if($author->profile_photo_path)
            <img src="{{ asset($author->profile_photo_path) }}" alt="{{ $author->name }}">
            @else
            <img src="{{ asset('abstrak/media/blog/author-3.png') }}" alt="Blog Author">
            @endif
        </div>
        <div class="info">
            <h5 class="title">{{ $author->name }}</h5>
            <p>{{ $author->bio ?? 'نویسنده سایت' }}</p>
        </div>
    </div>
</div>