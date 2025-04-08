<x-web-layout>
    <x-breadcrum-area>
        <li>
            <a href="{{ route('welcome', ['locale' => app()->getLocale()]) }}">
                <i class="fa-solid fa-duotone fa-house-heart"></i> صفحه خانه
            </a>
        </li>
        <li class="active">
            <i class="fa-solid fa-duotone fa-hashtag"></i> تکنولوژی های استک تیم 
        </li>
        <x-slot name="description">
            استک تیم در توسعه پروژه‌های خود از آخرین تکنولوژی‌های روز دنیا استفاده می‌کند تا محصولی با کیفیت و قدرتمند به مشتریان ارائه دهد. 🚀
        </x-slot>
    </x-breadcrum-area>

    @foreach($technologySections as $section)
    <section class="section section-padding bg-color-dark">
        <div class="container">
            <div class="section-heading heading-light-left">
                <span class="subtitle">{{ $section->name }}</span>
                <h2 class="title">{{ $section->title }}</h2>
                <!-- <p style="text-align: justify;">{{ $section->description }}</p> -->
            </div>
            <div class="row">
                @foreach($section->technologies as $technology)
                <div class="col-lg-4 col-md-6" data-sal="slide-up" data-sal-duration="800" data-sal-delay="100">
                    <div class="services-grid active">
                        <div class="thumbnail">
                            @if($technology->article)
                                <a href="{{ route('technology.article', ['name' => $technology->name, 'locale' => app()->getLocale(), 'slug' => $technology->article->slug]) }}">
                                    <x-icon :src="$technology->icon" :width="100" :height="100" alt="{{ $technology->title }}" />
                                </a>
                            @else
                                    <x-icon :src="$technology->icon" :width="100" :height="100" alt="{{ $technology->title }}" />
                            @endif
                        </div>
                        <div class="content">
                            <h5 class="title"><a href="{{ $technology->article ? route('technology.article', ['name' => $technology->name, 'locale' => app()->getLocale(), 'slug' => $technology->article->slug]) : '#' }}">{{ $technology->title }}</a></h5>
                            <p>{{ $technology->description }}</p>
                            @if($technology->article)
                                <a href="{{ route('technology.article', ['name' => $technology->name, 'locale' => app()->getLocale(), 'slug' => $technology->article->slug]) }}" class="more-btn">اطلاعات بیشتر</a>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <ul class="list-unstyled shape-group-10">
            <li class="shape shape-1">
                <img src="{{ asset('abstrak/media/others/line-9.png') }}" alt="دایره">
            </li>
        </ul>
    </section>
    @endforeach
</x-web-layout>