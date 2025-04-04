<!--=====================================-->
    <!--=      About  Quality Area Start    =-->
    <!--=====================================-->
    <section class="section section-padding bg-color-dark pb--80 pb_lg--40 pb_md--20">
        <div class="container">
            <div class="section-heading heading-light-left mb--100">
                <span class="subtitle">فرایند همکاری ما در استک تیم به چه صورت است؟</span>
                <h2 class="title">فرایند همکاری</h2>
                <p class="opacity-50">در استک تیم، فرآیند همکاری شفاف، سریع و ساده طراحی شده تا در کمترین زمان، بهترین تیم فنی را در کنار شما قرار دهیم.</p>
            </div>
            <div class="row">
                @foreach ($steps as $n => $step)
                <div class="col-lg-4">
                    <div class="about-quality {{ $n === 0 ? 'active' : '' }}">
                        <h3 class="sl-number">{{ $n + 1 }}</h3>
                        <h5 class="title">{{ $step['title'] }}</h5>
                        <p>{{ $step['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <ul class="list-unstyled shape-group-10">
            <li class="shape shape-1"><img src="{{ asset('abstrak/media/circle-1.png') }}" alt="Circle"></li>
            <li class="shape shape-2"><img src="{{ asset('abstrak/media/line-3.png') }}" alt="Circle"></li>
            <li class="shape shape-3"><img src="{{ asset('abstrak/media/bubble-5.png') }}" alt="Circle"></li>
        </ul>
    </section>
