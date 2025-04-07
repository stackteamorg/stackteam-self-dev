<div class="blog-author">
    <div class="author">
        <div class="author-thumb">
            @if($author->profileImage)
            <x-image :image="$author->profileImage" width="80" height="80" />            
            @endif
        </div>
        <div class="info">
            <h5 class="title" style="display: inline;">
                {{ $author->name }}
            </h5>
            @if($author->headline)
            <small style="display: inline;"><code>{{ $author->headline }}</code></small>
            @endif
            <br><br>
            <p style="text-align: justify;">{{ $author->biography ?? 'نویسنده سایت' }}</p>
            @if($author->location)
            <i class="fa-solid fa-location-dot" style="display: inline;"></i><p style="display: inline; margin-right: 10px;" class="location">{{ $author->location }}</p>
            @endif
        </div>
    </div>
</div>