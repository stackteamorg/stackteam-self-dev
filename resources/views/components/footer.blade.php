<!--=====================================-->
<!--=        Footer Area Start       	=-->
<!--=====================================-->
<footer class="footer-area">
    <div class="container">
        <div class="footer-top">
            <div class="footer-social-link">
                <ul class="list-unstyled">
                </ul>
            </div>
        </div>
        <div class="footer-main">
            <div class="row">
                <div class="col-xl-6 col-lg-5" data-sal="slide-right" data-sal-duration="800" data-sal-delay="100">
                    <div class="footer-widget border-end">
                        <div class="footer-newsletter">
                            <h2 class="title">با ما در ارتباط باشید!</h2>
                            <p style="text-align: justify;">
                                ما همیشه مشتاق شنیدن صدای شما هستیم! چه سوالی درباره خدمات  <code>Team as a Service (TaaS)</code> داشته باشید، چه نیاز به مشاوره در زمینه تشکیل تیم فنی، توسعه نرم‌افزار، یا حتی فقط بخواید درباره ایده‌تون با یک تیم با تجربه صحبت کنید، در 
                                <x-icon src="fa-duotone fa-solid fa-hashtag" width="14" height="14" /> <a href="{{ route('welcome',['locale' => app()->getLocale()]) }}">استک تیم</a>
                                 در کنار شماییم. ما به ارتباط شفاف و واقعی با مشتریان‌مون باور داریم و خوشحال می‌شیم با شما وارد گفت‌وگو بشیم. فرم زیر رو پر کنید تا در سریع‌ترین زمان ممکن باهاتون تماس بگیریم. می‌تونید از طریق واتساپ یا تماس مستقیم هم ارتباط بگیرید. منتظرتون هستیم!                            </p>
                            
                                <x-call-action buttonText="شروع همکاری" id="footer" />
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-7" data-sal="slide-left" data-sal-duration="800" data-sal-delay="100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="footer-widget">
                                <h6 class="widget-title"><i class="fa-duotone fa-solid fa-hashtag"></i> خدمات</h6>
                                <div class="footer-menu-link">
                                    <ul class="list-unstyled">
                                        @foreach($primaryServices as $service)
                                        <li>
                                            <a style="font-size: 14px !important;" href="{{ $service->article ? route('service.article', ['locale' => app()->getLocale(), 'name' => $service->name, 'slug' => $service->article->slug]) : '#' }}">
                                                <x-icon :src="$service->icon" :width="14" :height="14" /> {{ $service->title }}
                                            </a>
                                        </li>
                                        @endforeach                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="footer-widget">
                                <h6 class="widget-title">منابع</h6>
                                <div class="footer-menu-link">
                                    <ul class="list-unstyled">
                                        <li><a href="{{ route('service.index', App::currentLocale()) }}">{{ __('taas.menu.services') }}</a></li>
                                        <li><a href="{{ route('technology.index', App::currentLocale()) }}">{{ __('taas.menu.technologies') }}</a></li>
                                        <li><a href="{{ route('blog.index',App::currentLocale()) }}">{{ __('taas.menu.blog') }}</a></li>
                                        <li><a href="{{ route('about', ['locale' => App::currentLocale()]) }}">{{ __('taas.menu.about-us') }}</a></li>
                                        <li><a href="{{ route('process', ['locale' => App::currentLocale()]) }}">{{ __('taas.menu.process') }}</a></li>
                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom" data-sal="slide-up" data-sal-duration="500" data-sal-delay="100">
            <div class="row">
                <div class="col-md-6">
                    <div class="footer-copyright">
                        <span class="copyright-text">توسعه داده شده با <i class="fa-duotone fa-solid fa-heart" style="color: #ff0000;"></i>  عشق توسط <a href="https://stackteam.org/fa"> <i class="fa-duotone fa-solid fa-hashtag"></i> استک تیم</a>.</span>
                    <span>سرویسی از استک ایده</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="footer-bottom-link">
                        <ul class="list-unstyled">
                            {{-- <li><a href="privacy-policy.html">Privacy Policy</a></li>
                            <li><a href="terms-of-use.html">Terms of Use</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>