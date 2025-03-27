<x-web-layout>
    <x-breadcrum-area>
        <li><a href="{{ route('welcome', ['locale' => app()->getLocale()]) }}"><i class="fa-solid fa-house-heart"></i> صفحه خانه</a></li>
        <li class="active"><i class="fa-solid fa-hashtag"></i> خدمات استک تیم </li>
        <x-slot name="description">خدمات Team as a Service (TaaS) یک مدل نوین برای تأمین نیروی انسانی در پروژه‌های فناوری و توسعه نرم‌افزار است. در این مدل، شرکت‌ها به جای استخدام نیروی داخلی، یک تیم حرفه‌ای و متخصص را به‌صورت برون‌سپاری و ماهیانه در اختیار می‌گیرند 🚀</x-slot>
    </x-breadcrum-area>

        <!--=====================================-->
        <!--=        Service Area Start         =-->
        <!--=====================================-->
        <div class="service-scroll-navigation-area">
            <!-- Service Nav -->
            <nav id="onepagenav" class="service-scroll-nav navbar onepagefixed">
                <div class="container">
                    <ul class="nav nav-pills">
                        @foreach($primaryServices as $service)
                        <li class="nav-item">
                            <a class="nav-link" href="#section{{ $service->id }}">{{ $service->title }}</a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
            @foreach($primaryServices as $primaryService)
            <div class="section section-padding" id="section{{ $primaryService->id }}">
                <div class="container">
                    <div class="section-heading heading-left">
                        <span class="subtitle">{{ $primaryService->name }}</span>
                        <h2 class="title">{{ $primaryService->title }}</h2>
                        <p class="description">{{ $primaryService->description }}</p> <!-- دیسکریپشن دسته بندی -->
                        @if($primaryService->article)
                            <a href="{{ route('blog.article', ['locale' => app()->getLocale(), 'id' => $primaryService->article->id, 'slug' => $primaryService->article->slug]) }}" class="more-btn">مطالعه بیشتر</a>
                        @endif
                    </div>
                    <div class="row">
                        @foreach($primaryService->children as $service)
                        <div class="col-lg-4 col-md-6" data-sal="slide-up" data-sal-duration="800" data-sal-delay="100">
                            <div class="services-grid service-style-2">
                                <div class="thumbnail">
                                    <img src="{{ $service->icon }}" alt="icon">
                                </div>
                                <div class="content">
                                    <h5 class="title"> <a href="#">{{ $service->name }}</a></h5>
                                    <p>{{ $service->description }}</p>
                                    @if($service->article)
                                        <a href="{{ route('blog.article', ['locale' => app()->getLocale(), 'id' => $service->article->id, 'slug' => $service->article->slug]) }}" class="more-btn">اطلاعات بیشتر</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endforeach
        </div>

</x-web-layout>