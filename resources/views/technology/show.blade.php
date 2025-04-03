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
                        <x-article-comment />
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="axil-sidebar">
                        <div class="widget widget-search">
                            <h4 class="widget-title">جستجو</h4>
                            <form action="single-blog.html#" class="blog-search">
                                <input type="text" placeholder="جستجو...">
                                <button class="search-button"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        
                        <x-technology-sections :technologySections="$technologySections" />
                        <div class="widget widget-banner-ad">
                            <a href="single-blog.html#">
                                <img src="{{ asset('abstrak/media/banner/widget-banner.png') }}" alt="banner">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--=====================================-->
    <!--=       Recent Post Area Start      =-->
    <!--=====================================-->
    <section class="section section-padding-equal pt-0 related-blog-area">
        <div class="container">
            <div class="section-heading heading-left">
                <h3 class="title">پست های اخیر</h3>
            </div>
            <div class="slick-slider recent-post-slide" data-slick='{"infinite": true, "autoplay": true, "arrows": false, "dots": false, "slidesToShow": 2,"rtl":true,
        "responsive": [
            {
                "breakpoint": 1199,
                "settings": {
                    "slidesToShow": 1
                }
            }
        ]
        }'>
                <div class="slick-slide">
                    <div class="blog-list">
                        <div class="post-thumbnail">
                            <a href="single-blog.html"><img src="{{ asset('abstrak/media/blog/blog-1.png') }}" alt="Blog Post"></a>
                        </div>
                        <div class="post-content">
                            <h5 class="title"><a href="single-blog.html">چگونه از یک استراتژی بازاریابی مجدد برای کسب بیشتر استفاده کنیم</a></h5>
                            <p>تولید تقاضا یک مبارزه دائمی برای هر کسب و کاری است. هر استراتژی بازاریابی که استفاده می کنید دارای ...</p>
                            <a href="single-blog.html" class="more-btn">اطلاعات بیشتر<i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="slick-slide">
                    <div class="blog-list">
                        <div class="post-thumbnail">
                            <a href="single-blog.html"><img src="{{ asset('abstrak/media/blog/blog-2.png') }}" alt="Blog Post"></a>
                        </div>
                        <div class="post-content">
                            <h5 class="title"><a href="single-blog.html">آمار سئو که باید در سال 2021 بدانید</a></h5>
                            <p>جستجوی ارگانیک این پتانسیل را دارد که بیش از 40 درصد از درآمد ناخالص شما را به دست آورد...</p>
                            <a href="single-blog.html" class="more-btn">بیشتر بدانید<i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="slick-slide">
                    <div class="blog-list">
                        <div class="post-thumbnail">
                            <a href="single-blog.html"><img src="{{ asset('abstrak/media/blog/blog-1.png') }}" alt="Blog Post"></a>
                        </div>
                        <div class="post-content">
                            <h5 class="title"><a href="single-blog.html">چگونه از یک استراتژی بازاریابی مجدد برای کسب بیشتر استفاده کنیم</a></h5>
                            <p>تولید تقاضا یک مبارزه دائمی برای هر کسب و کاری است. هر استراتژی بازاریابی که استفاده می کنید دارای ...</p>
                            <a href="single-blog.html" class="more-btn">اطلاعات بیشتر<i class="far fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-web-layout>