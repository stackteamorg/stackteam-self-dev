<!DOCTYPE html>
<html class="no-js" lang="{{ $locate }}">

<head>
    <!-- Meta Data -->
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Abstrak | Home Startup</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('abstrak/media/favicon.png') }}">

    <!-- Language Font -->
    <x-style-layout style="font-lang" />

    <!-- Vendor CSS -->
    <x-style-layout style="css/vendor/bootstrap.min.css" />
    <x-style-layout style="css/vendor/font-awesome.css" />
    <x-style-layout style="css/vendor/slick.css" />
    <x-style-layout style="css/vendor/slick-theme.css" />
    <x-style-layout style="css/vendor/sal.css" />
    <x-style-layout style="css/vendor/magnific-popup.css" />
    <x-style-layout style="css/vendor/green-audio-player.min.css" />
    <x-style-layout style="css/vendor/odometer-theme-default.css" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.11.1/styles/github-dark-dimmed.min.css">


    <!-- Site Stylesheet -->
    <x-style-layout style="css/app.css" />

</head>

<body class="sticky-header" >
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
  	<![endif]-->
    <a href="#main-wrapper" id="backto-top" class="back-to-top">
        <i class="far fa-angle-double-up"></i>
    </a>

    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->

    <div class="my_switcher d-none d-lg-block">
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
    </div>

    <div id="main-wrapper" class="main-wrapper">
        <!--=====================================-->
        <!--=        Header Area Start       	=-->
        <!--=====================================-->
        <header class="header axil-header header-style-1">
            <div id="axil-sticky-placeholder"></div>
            <div class="axil-mainmenu">
                <div class="container">
                    <x-layout-menu />
                </div>
            </div>
        </header>
        {{ $slot }}

        <x-footer />

        <!--=====================================-->
        <!--=       Offcanvas Menu Area       	=-->
        <!--=====================================-->
        <div class="offcanvas offcanvas-end header-offcanvasmenu" tabindex="-1" id="offcanvasMenuRight">
            <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form action="#" class="side-nav-search-form">
                    <div class="form-group">
                        <input type="text" class="search-field" name="search-field" placeholder="Search...">
                        <button class="side-nav-search-btn"><i class="fas fa-search"></i></button>
                    </div>
                </form>
                <div class="row ">
                    <div class="col-lg-5 col-xl-6">
                        <ul class="main-navigation list-unstyled">
                            <li><a href="index-1.html">Digital Agency</a></li>
                            <li><a href="index-2.html">Creative Agency</a></li>
                            <li><a href="index-3.html">Personal Portfolio</a></li>
                            <li><a href="index-4.html">Home Startup</a></li>
                            <li><a href="index-5.html">Corporate Agency</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-7 col-xl-6">
                        <div class="contact-info-wrap">
                            <div class="contact-inner">
                                <address class="address">
                                    <span class="title">Contact Information</span>
                                    <p>Theodore Lowe, Ap #867-859 <br> Sit Rd, Azusa New York</p>
                                </address>
                                <address class="address">
                                    <span class="title">We're Available 24/7. Call Now.</span>
                                    <a class="tel" href="tel:8884562790"><i class="fas fa-phone"></i>(888)
                                        456-2790</a>
                                    <a class="tel" href="tel:12125553333"><i class="fas fa-fax"></i>(121)
                                        255-53333</a>
                                </address>
                            </div>
                            <div class="contact-inner">
                                <h5 class="title">Find us here</h5>
                                <div class="contact-social-share">
                                    <ul class="social-share list-unstyled">
                                        <li><a href="https://facebook.com/"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="https://twitter.com/"><i class="fab fa-x-twitter"></i></a></li>
                                        <li><a href="https://www.behance.net/"><i class="fab fa-behance"></i></a></li>
                                        <li><a href="https://www.linkedin.com/"><i class="fab fa-linkedin-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Jquery Js -->
    <script src="{{ asset('abstrak/js/vendor/jquery.min.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/bootstrap.min.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/odometer.min.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/jquery-appear.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/slick.min.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/sal.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/js.cookie.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/jquery.style.switcher.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/tilt.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/green-audio-player.min.js') }}"></script>
    <script src="{{ asset('abstrak/js/vendor/jquery.nav.js') }}"></script>
    


    <!-- Site Scripts -->
    <script src="{{ asset('abstrak/js/app.js') }}"></script>

    <!-- Highlight.js for code syntax highlighting -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>hljs.highlightAll();</script>
    
</body>

</html>