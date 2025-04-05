<x-web-layout>
    <x-about-section :heading="true" />
    <section class="section section-padding bg-color-light pb--70">
        <div class="container">            
            @foreach(__('about.process_steps') as $index => $step)
            <div class="process-work {{ $index % 2 != 0 ? 'content-reverse' : '' }}" data-sal="{{ $index % 2 == 0 ? 'slide-right' : 'slide-left' }}" data-sal-duration="1000" data-sal-delay="100">
                <div class="thumbnail paralax-image">
                    <img src="{{ asset($step['image']) }}" alt="{{ $step['title'] }}">
                </div>
                <div class="content">
                    <h3 class="title">{{ $step['title'] }}</h3>
                    <p>{{ $step['description'] }}</p>
                </div>
            </div>
            @endforeach
            
        </div>
        <ul class="shape-group-17 list-unstyled">
            <li class="shape shape-1"><img src="{{ asset('abstrak/media/others/bubble-24.png') }}" alt="Bubble"></li>
            <li class="shape shape-2"><img src="{{ asset('abstrak/media/others/bubble-23.png') }}" alt="Bubble"></li>
            <li class="shape shape-3"><img src="{{ asset('abstrak/media/others/line-4.png') }}" alt="Line"></li>
            <li class="shape shape-4"><img src="{{ asset('abstrak/media/others/line-5.png') }}" alt="Line"></li>
            <li class="shape shape-5"><img src="{{ asset('abstrak/media/others/line-4.png') }}" alt="Line"></li>
            <li class="shape shape-6"><img src="{{ asset('abstrak/media/others/line-5.png') }}" alt="Line"></li>
        </ul>
    </section>
    
    <x-call-section />

</x-web-layout> 