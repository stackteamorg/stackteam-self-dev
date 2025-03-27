<div class="header-navbar">
    <div class="header-logo">
        <h6 style="margin: 0 0 0px"><i class="fa-solid fa-brackets-curly"></i> استک تیم</h6>
    </div>
    <div class="header-main-nav">
        <!-- Start Mainmanu Nav -->
        <nav class="mainmenu-nav" id="mobilemenu-popup">
            <div class="d-block d-lg-none">
                <div class="mobile-nav-header">
                    <div class="mobile-nav-logo">
                        <a href="index-1.html">
                            <img class="light-mode" src="{{ asset('abstrak/media/logo-2.svg') }}" alt="Site Logo">
                            <img class="dark-mode" src="{{ asset('abstrak/media/logo-3.svg') }}" alt="Site Logo">
                        </a>
                    </div>
                    <button class="mobile-menu-close" data-bs-dismiss="offcanvas"><i class="fas fa-times"></i></button>
                </div>
            </div>
            <ul class="mainmenu">
                <li><a href="{{ route('welcome',App::currentLocale()) }}"><i class="fa-solid fa-house-heart"></i></a></li>
                <li><a href="{{ route('service.index', App::currentLocale()) }}">{{ __('taas.menu.services') }}</a></li>
                <li><a href="{{ route('technology.index', App::currentLocale()) }}">{{ __('taas.menu.technologies') }}</a></li>
                <li><a href="{{ route('blog.index',App::currentLocale()) }}">{{ __('taas.menu.blog') }}</a></li>
                <li><a href="contact.html">{{ __('taas.menu.about-us') }}</a></li>
                <li><a href="contact.html">{{ __('taas.menu.process') }}</a></li>
                <x-language-bar />
            </ul>
        </nav>
        <!-- End Mainmanu Nav -->
    </div>
    <div class="header-action">
        <ul class="list-unstyled">
            <li class="header-btn">
                <a href="{{ route('brief', App::currentLocale()) }}" class="axil-btn btn-fill-white">{{ __('taas.menu.brief') }}</a>
            </li>
            
            <li class="mobile-menu-btn sidemenu-btn d-lg-none d-block">
                <button class="btn-wrap" data-bs-toggle="offcanvas" data-bs-target="#mobilemenu-popup">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </li>
            <li class="my_switcher d-block d-lg-none">
                <ul>
                    <li title="Light Mode">
                        <a href="javascript:void(0)" class="setColor light" data-theme="light">
                            <i class="fal fa-lightbulb-on"></i>
                        </a>
                    </li>
                    <li title="Dark Mode">
                        <a href="javascript:void(0)" class="setColor dark" data-theme="dark">
                            <i class="fas fa-moon"></i>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>