<x-web-layout>
    <x-breadcrum-area>
        <li><a href="{{ route('welcome', ['locale' => app()->getLocale()]) }}"><i class="fa-solid fa-house-heart"></i> صفحه خانه</a></li>
        <li class="active"><i class="fa-solid fa-hashtag"></i> تکنولوژی های استک تیم </li>
        <x-slot name="description">استک تیم در توسعه پروژه‌های خود از آخرین تکنولوژی‌های روز دنیا استفاده می‌کند تا محصولی با کیفیت و قدرتمند به مشتریان ارائه دهد. 🚀</x-slot>
    </x-breadcrum-area>

        <!--=====================================-->
        <!--=        Service Area Start         =-->
        <!--=====================================-->
        <div class="service-scroll-navigation-area">
            <!-- Service Nav -->
            <nav id="onepagenav" class="service-scroll-nav navbar onepagefixed">
                <div class="container">
                    <ul class="nav nav-pills">
                        @foreach($technologySections as $section)
                        <li class="nav-item">
                            <a class="nav-link" href="#section{{ $section->id }}">{{ $section->name }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
            
            @foreach($technologySections as $section)
            <div class="section section-padding" id="section{{ $section->id }}">
                <div class="container">
                    <div class="section-heading heading-left">
                        <span class="subtitle">{{ $section->name }}</span>
                        <h2 class="title">{{ $section->title }}</h2>
                        <p>{{ $section->description }}</p>
                        @if($section->article)
                            <a href="{{ route('blog.article', ['locale' => app()->getLocale(), 'id' => $section->article->id, 'slug' => $section->article->slug]) }}" class="more-btn">مطالعه بیشتر</a>
                        @endif
                    </div>
                    <div class="row">
                        @foreach($section->technologies as $technology)
                        <div class="col-lg-4 col-md-6" data-sal="slide-up" data-sal-duration="800" data-sal-delay="100">
                            <div class="services-grid service-style-2">
                                <div class="thumbnail">
                                    <img src="{{ $technology->icon }}" alt="icon">
                                </div>
                                <div class="content">
                                    <h5 class="title"> <a href="#">{{ $technology->name }}</a></h5>
                                    <p>{{ $technology->description }}</p>
                                    @if($technology->article)
                                        <a href="{{ route('blog.article', ['locale' => app()->getLocale(), 'id' => $technology->article->id, 'slug' => $technology->article->slug]) }}" class="more-btn">اطلاعات بیشتر</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
            
            <section class="section section-padding bg-color-dark">
                <div class="container">
                    <div class="section-heading heading-light-left">
                        <span class="subtitle">مشتریان برتر</span>
                        <h2 class="title">ما راه‌حل‌هایی برای ... ایجاد کرده‌ایم</h2>
                        <p>هر چیزی را از آیکون‌های ساده تا وب‌سایت‌ها و برنامه‌های کاملاً کاربردی طراحی کنید.</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-6" data-sal="slide-up" data-sal-duration="500">
                            <div class="brand-grid active">
                                <img src="{{ asset('abstrak/media/brand/brand-1.png') }}" alt="برند">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6" data-sal="slide-up" data-sal-duration="500" data-sal-delay="100">
                            <div class="brand-grid">
                                <img src="{{ asset('abstrak/media/brand/brand-2.png') }}" alt="برند">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6" data-sal="slide-up" data-sal-duration="500" data-sal-delay="200">
                            <div class="brand-grid">
                                <img src="{{ asset('abstrak/media/brand/brand-3.png') }}" alt="برند">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6" data-sal="slide-up" data-sal-duration="500" data-sal-delay="300">
                            <div class="brand-grid">
                                <img src="{{ asset('abstrak/media/brand/brand-4.png') }}" alt="برند">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6" data-sal="slide-up" data-sal-duration="500" data-sal-delay="400">
                            <div class="brand-grid">
                                <img src="{{ asset('abstrak/media/brand/brand-5.png') }}" alt="برند">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6" data-sal="slide-up" data-sal-duration="500" data-sal-delay="500">
                            <div class="brand-grid">
                                <img src="{{ asset('abstrak/media/brand/brand-6.png') }}" alt="برند">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6" data-sal="slide-up" data-sal-duration="500" data-sal-delay="600">
                            <div class="brand-grid">
                                <img src="{{ asset('abstrak/media/brand/brand-7.png') }}" alt="برند">
                            </div>
                        </div>
                        <div class="col-lg-3 col-6" data-sal="slide-up" data-sal-duration="500" data-sal-delay="700">
                            <div class="brand-grid">
                                <img src="{{ asset('abstrak/media/brand/brand-8.png') }}" alt="برند">
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="list-unstyled shape-group-10">
                    <li class="shape shape-1"><img src="{{ asset('abstrak/media/others/line-9.png') }}" alt="دایره"></li>
                </ul>
            </section>
        </div>

</x-web-layout>