<x-web-layout>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1 class="mb-4">مقالات</h1>
            
            @foreach ($articles as $article)
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">{{ $article->title }}</h2>
                        <p class="card-text">{{ Str::limit($article->content, 200) }}</p>
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('blog.article', ['locale' => app()->getLocale(), 'slug' => $article->slug, 'id' => $article->id]) }}" class="btn btn-primary">ادامه مطلب</a>
                            <small class="text-muted">{{ $article->created_at->format('Y/m/d') }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <div class="d-flex justify-content-center">
                {{ $articles->links() }}
            </div>
        </div>
    </div>
</div>
</x-web-layout>