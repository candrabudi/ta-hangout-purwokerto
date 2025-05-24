<!DOCTYPE html>
<html lang="en">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - Hangout Purwokerto</title>
    <link rel="shortcut icon" href="{{ asset('template/frontend/img/logo/title2.svg') }}" type="image/x-icon" />
    <link rel="stylesheet" href="{{ asset('template/frontend/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/frontend/css/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/frontend/css/magnific-popup.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/frontend/css/nice-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/frontend/css/slick-slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/frontend/css/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/frontend/css/aos.css') }}" />
    <link rel="stylesheet" href="https://unpkg.com/swiper@11.2.6/swiper-bundle.min.css" />
    <link rel="stylesheet" href="{{ asset('template/frontend/css/mobile-menu.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/frontend/css/utility.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/frontend/css/main.css') }}" />
    <script src="{{ asset('template/frontend/js/jquery-3-7-1.min.js') }}"></script>
</head>

<body>
    <header>
        <div class="header-area header-area2 d-none d-lg-block" id="header">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="header-elements">
                            <div class="site-logo">
                                <a href="index-2.html">
                                    <img src="{{ asset('template/frontend/img/logo/logo-hangout.png') }}" alt="hangout logo" />
                                </a>
                            </div>
                            <div class="main-menu-ex main-menu-ex1">
                                <ul>
                                    <li><a href="{{ url('/') }}">Beranda</a></li>
                                    <li><a href="{{ url('/directories') }}">Direktori</a></li>
                                    <li><a href="{{ url('/about') }}">Tentang</a></li>
                                </ul>
                            </div>
                            <div class="header1-buttons">
                                <a class="theme-btn2" href="/">Website Purwokerto </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="mobile-header mobile-header-main d-block d-lg-none">
        <div class="container-fluid">
            <div class="col-12">
                <div class="mobile-header-elements">
                    <div class="mobile-logo">
                        <a href="404-2.html">
                            <img src="{{ asset('template/frontend/img/logo/logo-hangout.png') }}" alt="Logo Hangout" />
                        </a>
                    </div>
                    <div class="mobile-nav-icon">
                        <i class="fa-duotone fa-bars-staggered"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mobile-sidebar d-block d-lg-none">
        <div class="logo-m">
            <a href="index-2.html"><img src="{{ asset('template/frontend/img/logo/logo-hangout.png') }}" alt="vexon" /></a>
        </div>
        <div class="menu-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <div class="mobile-nav">
            <ul>
                <li><a href="{{ url('/') }}">Beranda</a></li>
                <li><a href="{{ url('/direktori') }}">Direktori</a></li>
                <li><a href="{{ url('/tentang') }}">Tentang</a></li>
            </ul>

            <div class="mobile-button">
                <a class="theme-btn1" href="{{ url('/kontak') }}">Get A Quote <i class="fa-solid fa-arrow-right"></i></a>
            </div>

            <div class="footer-contact-area1 md:pl-0 pl-20 sm:pl-0 mt-30">
                <h3 class="text-24 leading-26 font-semibold title1 pb-10">Get in touch</h3>
                <div class="contact-box d-flex">
                    <div class="icon">
                        <img src="{{ asset('template/frontend/img/icons/footer1-icon1.svg') }}" alt="vexon" />
                    </div>
                    <div class="text">
                        <a href="mailto:contact@vexon.com">contact@vexon.com</a>
                    </div>
                </div>

                <div class="contact-box d-flex">
                    <div class="icon">
                        <img src="{{ asset('template/frontend/img/icons/footer1-icon2.svg') }}" alt="vexon" />
                    </div>
                    <div class="text">
                        <a href="#">123 Innovation Drive,<br />Tech City, ST 12345, USA</a>
                    </div>
                </div>

                <div class="contact-box d-flex">
                    <div class="icon">
                        <img src="{{ asset('template/frontend/img/icons/footer1-icon3.svg') }}" alt="vexon" />
                    </div>
                    <div class="text">
                        <a href="tel:123-456-7890">123-456-7890</a>
                    </div>
                </div>
            </div>

            <div class="contact-infos">
                <h3>Our Social Network</h3>
                <ul class="social-icon">
                    <li><a href="#"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
    </div>

    @yield('user-content')
    <div class="footer1 mt-80 md:mt-40 sm:mt-40">
        <div class="container">
            {{-- <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="logo">
                        <a href="index.html"><img src="{{ asset('template/frontend/img/logo/logo-hangout.png') }}" width="80" alt="vexon" /></a>
                    </div>
                    <div class="logo-area2 mt-16">
                        <p>Temukan tempat hangout terbaik di Purwokerto untuk menikmati waktu bersama teman-teman dan keluarga. Jelajahi pilihan tempat nongkrong yang seru di sini.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-50 sm:mb-30 sm:mt-30">
                    <div class="footer-list2 ml-80 md:ml-0 sm:ml-0">
                        <h3>Menu</h3>
                        <ul>
                            <li><a href="#">Beranda</a></li>
                            <li><a href="#">Direktori</a></li>
                            <li><a href="#">Tentang</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-list2 mb-50 sm:mb-30">
                        <h3>Tempat Hangout Populer</h3>
                        <ul>
                            <li><a href="#">Alun-Alun Purwokerto</a></li>
                            <li><a href="#">Taman Andhang Pangrenan</a></li>
                            <li><a href="#">Baturaden</a></li>
                            <li><a href="#">GOR Satria</a></li>
                            <li><a href="#">The Village</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-50">
                    <div class="footer-contact-list2">
                        <h3>Hubungi Kami</h3>
                        <div class="footer-contact-box1">
                            <div class="icon">
                                <img src="/template/frontend/img/icons/footer2-contact1.svg" alt="vexon" />
                            </div>
                            <div class="text">
                                <a href="mailto:support@purwokerto.com">support@purwokerto.com</a>
                            </div>
                        </div>
                        <div class="footer-contact-box1">
                            <div class="icon">
                                <img src="/template/frontend/img/icons/footer2-contact2.svg" alt="vexon" />
                            </div>
                            <div class="text">
                                <a href="#">Purwokerto, Jawa Tengah, Indonesia</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="coppyrihgt1">
                <div class="row coppyrihgt-border">
                    <div class="col-md-6">
                        <p class="coppyrihgt">© 2025 Hangout Purwokerto. All Rights Reserved.</p>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="conditions">
                            <a href="#">Privacy Policy</a>
                            <a href="#">Terms & Conditions</a>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('template/frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/frontend/js/fontawesome.js') }}"></script>
    <script src="{{ asset('template/frontend/js/mobile-menu.js') }}"></script>
    <script src="{{ asset('template/frontend/js/jquery.magnific-popup.js') }}"></script>
    <script src="{{ asset('template/frontend/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('template/frontend/js/jquery.countup.js') }}"></script>
    <script src="{{ asset('template/frontend/js/slick-slider.js') }}"></script>
    <script src="{{ asset('template/frontend/js/circle-progress.js') }}"></script>
    <script src="{{ asset('template/frontend/js/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('template/frontend/js/gsap.min.js') }}"></script>
    <script src="{{ asset('template/frontend/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('template/frontend/js/swiper-bundle.js') }}"></script>
    <script src="{{ asset('template/frontend/js/Splitetext.js') }}"></script>
    <script src="{{ asset('template/frontend/js/text-animation.js') }}"></script>
    <script src="{{ asset('template/frontend/js/aos.js') }}"></script>
    <script src="{{ asset('template/frontend/js/SmoothScroll.js') }}"></script>
    <script src="{{ asset('template/frontend/js/jaquery-ripples.js') }}"></script>
    <script src="{{ asset('template/frontend/js/jquery.lineProgressbar.js') }}"></script>
    <script src="{{ asset('template/frontend/js/animation.js') }}"></script>
    <script src="{{ asset('template/frontend/js/main.js') }}"></script>
</body>

</html>
