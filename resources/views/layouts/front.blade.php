<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- GOOGLE WEB FONT -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="anonymous">
    <link rel="preload" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;display=swap"
        as="fetch" crossorigin="anonymous">

        <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('public/assets/img/easybuy4me.gif') }}" type="image/x-icon">

    <script type="text/javascript">
        ! function(e, n, t) {
            "use strict";
            var o = "https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&amp;display=swap",
                r = "__3perf_googleFonts_c2536";

            function c(e) {
                (n.head || n.body).appendChild(e)
            }

            function a() {
                var e = n.createElement("link");
                e.href = o, e.rel = "stylesheet", c(e)
            }

            function f(e) {
                if (!n.getElementById(r)) {
                    var t = n.createElement("style");
                    t.id = r, c(t)
                }
                n.getElementById(r).innerHTML = e
            }
            e.FontFace && e.FontFace.prototype.hasOwnProperty("display") ? (t[r] && f(t[r]), fetch(o).then(function(e) {
                return e.text()
            }).then(function(e) {
                return e.replace(/@font-face {/g, "@font-face{font-display:swap;")
            }).then(function(e) {
                return t[r] = e
            }).then(f).catch(a)) : a()
        }(window, document, localStorage);
    </script>

    <!-- BASE CSS -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="{{ asset('public/assets/css/home.css') }}" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="{{ asset('public/assets/css/custom.css') }}" rel="stylesheet">

    @yield('styles')
</head>

<body>
    <header class="header black_nav clearfix element_to_stick">
        <div class="container">
            <div id="logo">
                <a href="{{ url('') }}">
                    <img src="{{ asset('public/assets/img/logo.gif') }}" width="180" height="40" alt="">
                </a>
            </div>
            <div class="layer"></div><!-- Opacity Mask Menu Mobile -->
            <ul id="top_menu">
                <li><a href="#sign-in-dialog" id="sign-in" class="login">Sign In</a></li>
                <li><a href="#0" class="wishlist_bt_top" title="Your wishlist">Your wishlist</a></li>
            </ul>
            <!-- /top_menu -->
            <a href="#0" class="open_close">
                <i class="icon_menu"></i><span>Menu</span>
            </a>
            <nav class="main-menu">
                <div id="header_menu">
                    <a href="#0" class="open_close">
                        <i class="icon_close"></i><span>Menu</span>
                    </a>
                    <a href="{{ url('') }}">
                        {{-- <img src="{{ asset('assets/img/logo.gif') }}" width="162" height="35" alt=""> --}}
                        <h4 class="text-white">EasyBuy4Me</h4>
                    </a>
                </div>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Marketplace</a></li>
                </ul>
            </nav>
        </div>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <div class="wave footer"></div>
        <div class="container margin_60_40 fix_mobile">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <h3 data-bs-target="#collapse_1">Quick Links</h3>
                    <div class="collapse dont-collapse-sm links" id="collapse_1">
                        <ul>
                            <li><a href="#">About us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms & Condition </a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                        <h3 data-bs-target="#collapse_3">Contacts</h3>
                    <div class="collapse dont-collapse-sm contacts" id="collapse_3">
                        <ul>
                            <li><i class="icon_house_alt"></i>NO.15 NAMAIRO STREET,<br>LAFIA NASSARAWA STATE</li>
                            <li><i class="icon_mobile"></i>+234 903 151 4346</li>
                            <li><i class="icon_mail_alt"></i><a href="#0">support@easybuy4me.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                        <h3 data-bs-target="#collapse_4">Keep in touch</h3>
                    <div class="collapse dont-collapse-sm" id="collapse_4">
                        <div id="newsletter">
                            <div id="message-newsletter"></div>
                            <form method="post" action="" name="newsletter_form" id="newsletter_form">
                                <div class="form-group">
                                    <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
                                    <button type="submit" id="submit-newsletter"><i class="arrow_carrot-right"></i></button>
                                </div>
                            </form>
                        </div>
                        <div class="follow_us">
                            <h5>Follow Us</h5>
                            <ul>
                                <li><a href="www.twitter.com/easybuy4me"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('public/assets/img/twitter_icon.svg') }}" alt="" class="lazy"></a></li>
                                <li><a href="web.facebook.com/easybuy4me"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('public/assets/img/facebook_icon.svg') }}" alt="" class="lazy"></a></li>
                                <li><a href="www.instagram.com/easybuy4me"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="{{ asset('public/assets/img/instagram_icon.svg') }}" alt="" class="lazy"></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row-->
            <hr>
            <div class="row add_bottom_25">
                <div class="d-flex justify-content-center">
                    <ul class="additional_links">
                        <li><a href="#0">Terms and conditions</a></li>
                        <li><a href="#0">Privacy</a></li>
                        <li><span>© EasyBuy4Me Ventures</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- COMMON SCRIPTS -->
    <script src="{{ asset('public/assets/js/common_scripts.min.js') }}"></script>
    <script src="{{ asset('public/assets/js/common_func.js') }}"></script>
    <script src="{{ asset('public/assets/assets/validate.js') }}"></script>

    <!-- TYPE EFFECT -->
    <script src="{{ asset('public/assets/js/typed.min.js') }}"></script>
    <script>
        var typed = new Typed('.element', {
            strings: ["Need someone to run your errands ", "from doing your groceries shopping,",
                "to ordering food from your favourite restaurant.",
                "EasyBuy4Me have you covered to your doorstep."
            ],
            startDelay: 10,
            loop: true,
            backDelay: 2000,
            typeSpeed: 50
        });
    </script>

    <!-- Autocomplete -->
    <script>
        function initMap() {
            var input = document.getElementById('autocomplete');
            var autocomplete = new google.maps.places.Autocomplete(input);

            autocomplete.addListener('place_changed', function() {
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    window.alert("Autocomplete's returned place contains no geometry");
                    return;
                }

                var address = '';
                if (place.address_components) {
                    address = [
                        (place.address_components[0] && place.address_components[0].short_name || ''),
                        (place.address_components[1] && place.address_components[1].short_name || ''),
                        (place.address_components[2] && place.address_components[2].short_name || '')
                    ].join(' ');
                }
            });
        }
    </script>
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBH-1noGUoStq-5nLCbxHLhAPHN1kPrW2k&amp;libraries=places&amp;callback=initMap">
    </script>

    @yield('scripts')

</body>

</html>
