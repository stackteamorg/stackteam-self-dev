<x-web-layout>
    <section class="section section-padding bg-color-light pb--70">
        <div class="container">
            <div class="section-heading mb--90">
                <span class="subtitle">{{ __('process.subtitle') }}</span>
                <h2 class="title" style="text-align: center !important">{{ __('process.title') }}</h2>
                <p style="text-align: justify;">{{ __('process.description') }}</p>
            </div>
            
            @foreach(__('process.steps') as $index => $step)
                <div class="process-work {{ $index % 2 != 0 ? 'content-reverse' : '' }} {{ $index < 2 ? 'sal-animate' : '' }}" 
                     data-sal="{{ $index % 2 == 0 ? 'slide-right' : 'slide-left' }}" 
                     data-sal-duration="1000" 
                     data-sal-delay="100">
                    <div class="thumbnail paralax-image">
                        <img src="{{ asset($step['image']) }}" alt="{{ $step['title'] }}">
                    </div>
                    <div class="content">
                        <span class="subtitle">{{ $step['subtitle'] }} {{ $step['icon'] }}</span>
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
</x-web-layout>
