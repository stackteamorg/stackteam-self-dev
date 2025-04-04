<section class="section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="why-choose-us">
                    <div class="section-heading heading-left">
                        <span class="subtitle">{{ __('about.title') }}</span>
                        <p style="text-align: justify;">
                            {{ __('about.description') }}
                            {{ __('about.details') }}
                        </p>
                    </div>
                    <div class="accordion" id="choose-accordion">
                        @foreach ( __('about.accordion') as $n => $item)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading{{ $n }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $n }}" aria-expanded="false" aria-controls="collapse{{ $n }}">
                                    <x-icon :src="$item['icon']" width="24" height="24" /> {{ $item['title'] }}
                                </button>
                            </h2>
                            <div id="collapse{{ $n }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $n }}" data-bs-parent="#choose-accordion">
                                <div class="accordion-body">
                                    {{ $item['content'] }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-xl-5 col-lg-12 offset-xl-1">
                <div class="banner-thumbnail sal-animate" data-sal="slide-up" data-sal-duration="1000" data-sal-delay="400">
                    <img class="paralax-image" src="{{ asset('abstrak/media/banner/about-us.png') }}" alt="Illustration" style="will-change: transform; transform: perspective(1000px) rotateX(0deg) rotateY(0deg); border-radius: 10%;">
                </div>
            </div>
        </div>
    </div>
</section>