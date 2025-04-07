<x-web-layout>

    {{-- <x-article-breadcrum :article="$article" /> --}}

    <x-breadcrum-area>
        <li><a href="{{ route('welcome', ['locale' => app()->getLocale()]) }}"><i class="fa-solid fa-house-heart"></i> صفحه خانه</a></li>
        <li><a href="{{ route('blog.index', ['locale' => app()->getLocale()]) }}"><i class="fa-solid fa-hashtag"></i> بلاگ </a></li>
        <li class="active"><i class="fa-solid fa-hashtag"></i> {{ $article->category->title }}</li>
    </x-breadcrum-area>
    
    <!--=====================================-->
    <!--=        Blog Area Start       	    =-->
    <!--=====================================-->
    <section class="section-padding-equal">
        <div class="container">
            <div class="row row-40">
                <div class="col-lg-8">
                    <div class="single-blog">
                        <x-article-content :article="$article" />
                        @if($article->author)
                        <x-article-author :author="$article->author" />
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="axil-sidebar">
                        <div class="widget widget-search">
                            <h4 class="widget-title"><i class="fa-solid fa-hashtag"></i> همکاری</h4>
                            <x-call-action buttonText="شروع" />
                        </div>
                        <x-article-categories />
                        
                        <x-latest-article />
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>