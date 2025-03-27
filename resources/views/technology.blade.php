<x-web-layout>
    <x-breadcrum-area>
        <li>
            <a href="{{ route('welcome', ['locale' => app()->getLocale()]) }}">
                <i class="fa-solid fa-house-heart"></i> صفحه خانه
            </a>
        </li>
        <li class="active">
            <i class="fa-solid fa-hashtag"></i> تکنولوژی های استک تیم 
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
                <p style="text-align: justify;">{{ $section->description }}</p>
            </div>
            <div class="row">
                @foreach($section->technologies as $technology)
                <div class="col-lg-3 col-6" data-sal="slide-up" data-sal-duration="500">
                    <div class="brand-grid">
                        <a href="{{ route('blog.article', ['id' => $technology->article->id, 'locale' => app()->getLocale(), 'slug' => $technology->article->slug]) }}">
                            <i class="{{ $technology->icon }}" style="font-size: 95px;"></i>
                        </a>
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