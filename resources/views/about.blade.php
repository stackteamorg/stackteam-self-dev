<x-web-layout>
    <x-about-section :heading="true" />

    @foreach(__('about.process_steps') as $index => $step)
    <section class="section-padding case-study-brief">
        <div class="container">
            <div class="row align-items-xl-center">
                <div class="col-lg-6 sal-animate" data-sal="{{ $index % 2 == 0 ? 'slide-right' : 'slide-left' }}" data-sal-duration="1000">
                    <div class="case-study-featured-thumb">
                        <img class="paralax-image" style="border-radius: 5%;will-change: transform; transform: perspective(1000px) rotateX(0deg) rotateY(0deg);" src="{{ asset($step['image']) }}" alt="{{ $step['title'] }}">
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 offset-xl-1 sal-animate" data-sal="{{ $index % 2 == 0 ? 'slide-left' : 'slide-right' }}" data-sal-duration="1000" data-sal-delay="200">
                    <div class="case-study-featured">
                        <div class="section-heading heading-{{ $index % 2 == 0 ? 'left' : 'right' }}">
                            <h2 class="title h4">{{ $step['title'] }}</h2>
                            <p style="text-align: justify;">{{ $step['description'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endforeach
    
    <x-call-section />

</x-web-layout> 