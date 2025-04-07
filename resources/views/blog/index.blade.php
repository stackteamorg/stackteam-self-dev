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
                        @if($articles->isEmpty())
                            <p>هیچ مقاله ای موجود نیست.</p>
                        @else
                            @foreach($articles as $article)
                            <div class="blog-grid">
                                <h3 class="title h4"><a href="{{ route('blog.article', ['locale' => app()->getLocale(), 'slug' => $article->slug, 'id' => $article->id]) }}">{{ $article->title }}</a></h3>
                                <div class="author">
                                    @if($article->author)
                                    <div class="author-thumb">
                                        @if($article->author->profileImage)
                                            <x-image :image="$article->author->profileImage" width="64" height="64" /> 
                                        @else
                                            <x-image :image="$article->author->profileImage" width="64" height="64" /> 
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
                                    <a href="{{ route('blog.article', ['locale' => app()->getLocale(), 'slug' => $article->slug, 'id' => $article->id]) }}">
                                        <img src="{{ asset('storage/'.$article->image->path) }}" alt="{{ $article->title }}">
                                    </a>
                                    @endif
                                </div>
                                <x-article-short-content :content="$article->content" :limit="400" />

                                <a href="{{ route('blog.article', ['locale' => app()->getLocale(), 'slug' => $article->slug, 'id' => $article->id]) }}" class="axil-btn btn-borderd btn-large">بیشتر بخوانید</a>
                            </div>
                            @endforeach
                        @endif
                        
                        <div class="pagination">
                            {{ $articles->links('vendor.pagination.custom') }}
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="axil-sidebar">
                            <div class="widget widget-search">
                                <h4 class="widget-title"><i class="fa-solid fa-hashtag"></i> همکاری</h4>
                                <form class="input-group">
                                    <input type="tel" class="form-control" placeholder=" شماره موبایل">
                                    <button class="subscribe-btn" type="submit">شروع</button>
                                </form>
                            </div>

                            <x-article-categories />
                            <x-latest-article />
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
</x-web-layout>