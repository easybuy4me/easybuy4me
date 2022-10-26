@extends('layouts.front')

@section('content')

<div class="hero_single version_1">
    <div class="opacity-mask">
        <div class="container">
            <div class="row justify-content-lg-start justify-content-md-center">
                <div class="col-xl-7 col-lg-8">
                    <h1>Hello Dear,</h1>
                    <p><span class="element" style="font-weight: 500"></span></p>
                    <a class="btn_1 gradient">Run my Errand</a>
                    <a class="btn_1 gradient">Marketplace</a>
                </div>
            </div>
            <!-- /row -->
        </div>
    </div>
    <div class="wave hero"></div>
</div>
<!-- /hero_single -->
<div class="shape_element_2">
    <div class="container margin_60_0">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="box_how">
                            <figure><img src="{{ asset('public/assets/img/lazy-placeholder-100-100-white.png') }}" data-src="{{ asset('public/assets/img/how_1.svg') }}"
                                    alt="" width="150" height="167" class="lazy"></figure>
                            <h3>Easly Order</h3>
                            <p></p>
                        </div>
                        <div class="box_how">
                            <figure><img src="{{ asset('public/assets/img/lazy-placeholder-100-100-white.png') }}" data-src="{{ asset('public/assets/img/how_2.svg') }}"
                                    alt="" width="130" height="145" class="lazy"></figure>
                            <h3>Quick Delivery</h3>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-center">
                        <div class="box_how">
                            <figure><img src="{{ asset('public/assets/img/lazy-placeholder-100-100-white.png') }}" data-src="{{ asset('public/assets/img/how_3.svg') }}"
                                    alt="" width="150" height="132" class="lazy"></figure>
                            <h3>Enjoy Food</h3>
                            <p></p>
                        </div>
                    </div>
                </div>
                <p class="text-center mt-3 d-block d-lg-none"><a href="#0"
                        class="btn_1 medium gradient pulse_bt mt-2">Register Now!</a></p>
            </div>
            <div class="col-lg-5 offset-lg-1 align-self-center">
                <div class="intro_txt">
                    <div class="main_title">
                        <span><em></em></span>
                        <h2>About Us</h2>
                    </div>
                    <p class="lead">
                        Easybuy4Me is an online errand service that makes it convenient for you to
                        get your errands run. From doing your groceries shopping, to ordering food from your
                        favourite restaurant.
                        EasyBuy4Me can run the errands and get it delivered to your doorstep.
                    </p>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="bg_gray">
    <div class="container margin_60_40">
        <!-- /row -->
        <div class="banner lazy" data-bg="url({{ asset('public/assets/img/imm.jpg') }})">
            <div class="wrapper d-flex align-items-center opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
                <div>
                    <small>Easybuy4Me Ventures</small>
                    <h3>Sell with Us</h3>
                    <p>get access to a wide range of customers<br/> that make daily
                        purchases on our platforms.</p>
                    <a href="{{ url('vendor/regsiter') }}" class="btn_1 gradient">Start Now!</a>
                </div>
            </div>
            <!-- /wrapper -->
        </div>
        <!-- /banner -->
    </div>
</div>

@endsection
