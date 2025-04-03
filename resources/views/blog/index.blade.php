<x-web-layout>
    <x-breadcrum-area>
        <li><a href="{{ route('welcome', ['locale' => app()->getLocale()]) }}"><i class="fa-solid fa-house-heart"></i> صفحه خانه</a></li>
        <li class="active"><i class="fa-solid fa-hashtag"></i> بلاگ </li>
    </x-breadcrum-area>

<!--=====================================-->
        <!--=        Blog Area Start       	    =-->
        <!--=====================================-->
        <section class="section-padding-equal">
            <div class="container">
                <div class="row row-40">
                    <div class="col-lg-8">
                        @foreach($articles as $article)
                        <div class="blog-grid">
                            <h3 class="title"><a href="{{ route('article.show', ['locale' => app()->getLocale(), 'slug' => $article->slug, 'id' => $article->id]) }}">{{ $article->title }}</a></h3>
                            <div class="author">
                                @if($article->author)
                                <div class="author-thumb">
                                    @if($article->author->image)
                                    <img src="{{ asset('storage/'.$article->author->image->path) }}" alt="{{ $article->author->name }}">
                                    @else
                                    <img src="{{ asset('assets/media/blog/author-1.png') }}" alt="{{ $article->author->name }}">
                                    @endif
                                </div>
                                <div class="info">
                                    <h6 class="author-name">{{ $article->author->name }}</h6>
                                    <ul class="blog-meta list-unstyled">
                                        <li>{{ $article->created_at->format('d F Y') }}</li>
                                        <li>{{ ceil(str_word_count(strip_tags($article->content)) / 200) }} دقیقه برای خواندن</li>
                                    </ul>
                                </div>
                                @endif
                            </div>
                            <div class="post-thumbnail">
                                @if($article->image)
                                <a href="{{ route('article.show', ['locale' => app()->getLocale(), 'slug' => $article->slug, 'id' => $article->id]) }}">
                                    <img src="{{ asset('storage/'.$article->image->path) }}" alt="{{ $article->title }}">
                                </a>
                                @else
                                <a href="{{ route('article.show', ['locale' => app()->getLocale(), 'slug' => $article->slug, 'id' => $article->id]) }}">
                                    <img src="{{ asset('assets/media/blog/blog-3.png') }}" alt="{{ $article->title }}">
                                </a>
                                @endif
                            </div>
                            <p>{{ Str::limit(strip_tags($article->content), 200) }}</p>
                            <a href="{{ route('article.show', ['locale' => app()->getLocale(), 'slug' => $article->slug, 'id' => $article->id]) }}" class="axil-btn btn-borderd btn-large">بیشتر بخوانید</a>
                        </div>
                        @endforeach
                        
                        <div class="pagination">
                            {{ $articles->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="axil-sidebar">
                            <div class="widget widget-search">
                                <h4 class="widget-title">جستجو</h4>
                                <form action="{{ route('blog.index', ['locale' => app()->getLocale()]) }}" method="GET" class="blog-search">
                                    <input type="text" name="search" placeholder="جستجو…" value="{{ request('search') }}">
                                    <button type="submit" class="search-button"><i class="fal fa-search"></i></button>
                                </form>
                            </div>
                            <div class="widget widget-categories">
                                <h4 class="widget-title">دسته‌ها</h4>
                                <ul class="category-list list-unstyled">
                                    @foreach(\App\Models\Category::where('lang', app()->getLocale())->get() as $category)
                                    <li><a href="{{ route('blog.category', ['locale' => app()->getLocale(), 'slug' => $category->slug]) }}">{{ $category->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="widget widge-social-share">
                                <div class="blog-share">
                                    <h5 class="title">دنبال کنید:</h5>
                                    <ul class="social-list list-unstyled">
                                        <li><a href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/"><i class="fab fa-x-twitter"></i></a></li>
                                        <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a></li>
                                        <li><a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="https://www.youtube.com/"><i class="fab fa-youtube"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="widget widget-recent-post">
                                <h4 class="widget-title">پست‌های اخیر</h4>
                                <div class="post-list-wrap">
                                    @foreach(\App\Models\Article::where('status', 'published')->where('lang', app()->getLocale())->latest()->take(3)->get() as $recentArticle)
                                    <div class="single-post">
                                        <div class="post-thumbnail">
                                            @if($recentArticle->image)
                                            <a href="{{ route('article.show', ['locale' => app()->getLocale(), 'slug' => $recentArticle->slug, 'id' => $recentArticle->id]) }}">
                                                <img src="{{ asset('storage/'.$recentArticle->image->path) }}" alt="{{ $recentArticle->title }}">
                                            </a>
                                            @else
                                            <a href="{{ route('article.show', ['locale' => app()->getLocale(), 'slug' => $recentArticle->slug, 'id' => $recentArticle->id]) }}">
                                                <img src="{{ asset('assets/media/blog/blog-5.png') }}" alt="{{ $recentArticle->title }}">
                                            </a>
                                            @endif
                                        </div>
                                        <div class="post-content">
                                            <h6 class="title">
                                                <a href="{{ route('article.show', ['locale' => app()->getLocale(), 'slug' => $recentArticle->slug, 'id' => $recentArticle->id]) }}">
                                                    {{ Str::limit($recentArticle->title, 60) }}
                                                </a>
                                            </h6>
                                            <ul class="blog-meta list-unstyled">
                                                <li>{{ $recentArticle->created_at->format('d F Y') }}</li>
                                                <li>{{ ceil(str_word_count(strip_tags($recentArticle->content)) / 200) }} دقیقه برای خواندن</li>
                                            </ul>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="widget widget-banner-ad">
                                <a href="#">
                                    <img src="{{ asset('assets/media/banner/widget-banner.png') }}" alt="بنر">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
</x-web-layout>