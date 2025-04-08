<x-web-layout>
 <!--=====================================-->
    <!--=           404 Area Start          =-->
    <!--=====================================-->
    <section class="error-page onepage-screen-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="content" data-sal="slide-up" data-sal-duration="800" data-sal-delay="400">
                        <h2 class="title">صفحه ای یافت نشد</h2>
                        <span class="subtitle" style="text-align: justify;">
                            با <x-icon src="fa-duotone fa-solid fa-hashtag" width="14" height="14" /> <a href="{{ route('welcome',['locale' => app()->getLocale()]) }}">استک تیم</a>، بدون دغدغه استخدام، یک تیم کامل و حرفه‌ای برای طراحی و توسعه وب‌سایت یا اپلیکیشن خود داشته باشید. ما راهکار <code>Team as a Service (TaaS)</code> را به شما ارائه می‌دهیم. یعنی به جای برون‌سپاری پروژه به یک فریلنسر یا آژانس، یک تیم اختصاصی متناسب با نیاز پروژه‌تان در اختیار خواهید داشت  
                        </span>                            
                        <a href="{{ route('welcome',['locale' => app()->getLocale()]) }}" class="axil-btn btn-fill-primary" style="margin-top: 20px;">صفحه خانه</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="thumbnail" data-sal="zoom-in" data-sal-duration="800" data-sal-delay="400">
                        <img src="{{ asset('abstrak/media/others/404.png') }}" alt="404">
                    </div>
                </div>
            </div>
        </div>
        <ul class="shape-group-8 list-unstyled">
            <li class="shape shape-1" data-sal="slide-right" data-sal-duration="500" data-sal-delay="100">
                <img src="{{ asset('abstrak/media/others/bubble-9.png') }}" alt="Bubble">
            </li>
            <li class="shape shape-2" data-sal="slide-left" data-sal-duration="500" data-sal-delay="200">
                <img src="{{ asset('abstrak/media/others/bubble-27.png') }}" alt="Bubble">
            </li>
            <li class="shape shape-3" data-sal="slide-up" data-sal-duration="500" data-sal-delay="300">
                <img src="{{ asset('abstrak/media/others/line-4.png') }}" alt="Line">
            </li>
        </ul>
    </section>

</x-web-layout>