<div class="col-lg-9 col-md-6 col-sm-6 col-4">
    <div class="mainmenu-wrapepr">
        <!-- Start Mainmanu Nav -->
        <nav class="mainmenu-nav d-none d-lg-block">
            <ul class="mainmenu">


                <li><a href="home-05.html">{{ __('taas.menu.home') }}</a></li>
                <li><a href="button.html">{{ __('taas.menu.services') }}</a></li>
                <li><a href="button.html">{{ __('taas.menu.technologies') }}</a></li>
                <li><a href="{{ route('blog.index',App::currentLocale()) }}">{{ __('taas.menu.blog') }}</a></li>
                
                <li><a href="button.html">{{ __('taas.menu.about-us') }}</a></li>
                <li><a href="button.html">{{ __('taas.menu.process') }}</a></li>
                <li style="padding-right: 12px;"><i class="fa-solid fa-lightbulb-cfl-on"></i></li>
                <x-language-bar />
            </ul>
        </nav>
        <!-- End Mainmanu Nav -->

        <!-- Start Hamburger -->
        <div class="ax-header-button ml--40 ml_lg--10 d-none d-sm-block">
            <a class="axil-button btn-solid btn-extra02-color" href="home-04.html#"><span class="button-text">{{ __('taas.menu.brief') }}</span><span class="button-icon"></span></a>
        </div>
        <!-- End Hamburger -->

        <!-- Start Menu Bar  -->
        <div class="ax-menubar popup-navigation-activation d-block d-lg-none ml_sm--20 ml_md--20">
            <div>
                <i></i>
            </div>
        </div>
        <!-- End Menu Bar  -->
    </div>
</div>