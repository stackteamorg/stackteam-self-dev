<section class="section section-padding bg-color-light">
    <div class="container">
        <div class="section-heading heading-left">
            <span class="subtitle">ما چه کاری می‌توانیم برای شما انجام دهیم</span>
            <h2 class="title">خدماتی که می‌توانیم <br> به شما کمک کنیم</h2>
        </div>
        <div class="row">
            @foreach($primaryServices as $service)
                <div class="col-lg-4 col-md-6" data-sal="slide-up" data-sal-duration="800" data-sal-delay="{{ $loop->index * 100 }}">
                    <div class="services-grid service-style-2">
                        <div class="thumbnail">
                            <x-icon :src="$service->icon" />
                        </div>
                        <div class="content">
                            <h5 class="title"> <a href="{{ route('service.article', ['locale' => app()->getLocale(), 'name' => $service->name, 'slug' => $service->article->slug]) }}">{{ $service->title }}</a></h5>
                            <p>{{ $service->description }}</p>
                            <a href="{{ route('service.article', ['locale' => app()->getLocale(), 'name' => $service->name, 'slug' => $service->article->slug]) }}" class="more-btn">بیشتر بدانید</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>