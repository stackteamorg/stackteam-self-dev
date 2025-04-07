<x-web-layout>

    <x-breadcrum-area>
        <li>
            <a href="{{ route('welcome', ['locale' => app()->getLocale()]) }}">
                <i class="fa-solid fa-house-heart"></i> صفحه خانه
            </a>
        </li>
        <li class="">
            <a href="{{ route('technology.index', ['locale' => app()->getLocale()]) }}"><i class="fa-solid fa-hashtag"></i> تکنولوژی ها</a>
        </li>
        <li class="active">
            <i class="fa-solid fa-hashtag"></i> {{ $technology->title }}
        </li>
        <x-slot name="title">
            <i class="fa-solid fa-hashtag"></i> {{ $article->title }}
        </x-slot>
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
                        {{-- <x-article-comment /> --}}
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
                        
                        <x-technology-sections :technologySections="$technologySections" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=====================================-->
    <!--=       Recent Post Area Start      =-->
    <!--=====================================-->
    

</x-web-layout>