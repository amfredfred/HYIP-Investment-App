@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Investment Platform</title>
<meta  name="description" content="Investment Platform">
<meta itemprop="keywords" name="keywords" content="Investment Platform"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('headerText')
<div class="header__cta-text text-center" data-aos="fade-up">
            <div class="col-md-6 col-sm-8 m-auto">
                <h1>
                    Welcome to <span class="site-name">TASC</span> Investment Bank
                </h1>
                <p class="mt-4">
                    A Modern Investment Firm For Cryptocurrencies And Digital Assets Management.
                </p>
                @Auth
                
                <a href="{{url('home')}}" class="btn btn--cta mt-5">Dashboard</a>
                @else
                <a href="{{url('register')}}" class="btn btn--cta mt-5">Create Account</a>
                @endAuth
            </div>
        </div>

        <div class="coinlink-marquee">
            <div
                style="height:62px; background-color: #1D2330; overflow:hidden; box-sizing: border-box; border: 1px solid #282E3B; border-radius: 4px; text-align: right; line-height:14px; block-size:62px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #262B38;padding:1px;padding: 0px; margin: 0px; width: 100%;">
                <div style="height:40px; padding:0px; margin:0px; width: 100%;"><iframe
                        src="https://widget.coinlib.io/widget?type=horizontal_v2&theme=dark&pref_coin_id=1505&invert_hover="
                        width="100%" height="36px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0"
                        border="0" style="border:0;margin:0;padding:0;"></iframe></div>
                <div
                    style="color: #626B7F; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;">
                    <a href="https://coinlib.io" target="_blank"
                        style="font-weight: 500; color: #626B7F; text-decoration:none; font-size:11px">Cryptocurrency
                        Prices</a>&nbsp;by Coinlib</div>
            </div>
        </div>

@endsection
@section('content')
<main>
        <section class="c-about-us">
            <div class="container-fluid">
                <div class="row justify-content-end">
                    <div class="col-md-5 mb-4">
                        <div class="c-about-us__content">
                            <article data-aos="fade-up">
                                <h3 class="mb-3  c-about-us__title">
                                    About us
                                </h3>
                                <p>
                                    TASC Investment is a leading ECN/STP Forex Broker providing services and trading
                                    facilities to
                                    retail, institutional and professional clients globally with particular focus on
                                    forex
                                    trading
                                    strategies such as scalping and the acceptance of forex scalping systems.
                                </p>
                                <a href="{{url('about-us')}}" class="c-link">Learn More >></a>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="c-intro-video" data-aos="fade-up">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="col-md-6 mb-5">

                        <iframe width="100%" height="315" src=" {{$settings['video_link']}}"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                    <div class="col-md-5">
                        <h3 class="mb-4">
                            You're in control
                        </h3>
                        <p>
                            Our sterling reputation, dedication to meeting our clients’ needs and innovative approach to
                            business development are some driving forces behind our success.
                        </p>
                        <p>
                            Our dream today is for investors to testify and spread the word about Metall Investment
                            fighting for the good course of making individuals wealthy.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <section class="c-what-we-do">
            <div class="container-fluid">
                <div class="text-center col-sm-8 col-md-6 m-auto" data-aos="fade-up">
                    <h3>
                        We are professionals when it comes to cryptocurrency investment
                    </h3>
                    <a href="{{url('register')}}" class="btn btn-outline-light mt-3 py-2 px-4">Get Started</a>
                </div>
            </div>
        </section>
        <section class="c-features">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 col-md-3">
                        <div class="c-benefit c-benefit--main">
                            <h5 class="c-benefit__title">
                                Best benefits for you
                            </h5>
                            <p class="c-benefit__info">
                                TASC offers the best investment benefits you can find
                            </p>
                            <a href="{{url('register')}}" class="btn c-benefit__invest-btn px-5">Invest Now <i
                                    class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">

                        <div class="c-benefit shadow-sm" data-aos="fade-up">
                            <i class="c-benefit__icon fa fa-square fa-4x mb-3"></i>
                            <h5 class="c-benefit__title">
                                Excellent, flexible plans
                            </h5>
                            <p class="c-benefit__info">
                                TASC's plans are flexible and designed to ease the process of investing while meeting
                                your budget
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="c-benefit shadow-sm" data-aos="fade-up">
                            <i class="c-benefit__icon fa fa-sticky-note fa-4x mb-3"></i>
                            <h5 class="c-benefit__title">
                                Best ROI, interests
                            </h5>
                            <p class="c-benefit__info">
                                TASC offers the best return on investments with returned interests improving depending
                                on plan
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="c-benefit shadow-sm" data-aos="fade-up">
                            <i class="c-benefit__icon fa fa-map fa-4x mb-3"></i>
                            <h5 class="c-benefit__title">
                                Quick, fast withdrawal
                            </h5>
                            <p class="c-benefit__info">
                                Our withdrawals are near instant, it takes only 2 business days to process
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="c-why-us">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-5 mb-4">
                        <div class="c-why-us__text p-5 rounded" data-aos="fade-up">
                            <span>
                                Why Us
                            </span>
                            <h2>
                                TASC is the number one choice for thousands of investors, seeking maximum returns with
                                virtually no risks.
                            </h2>
                            <p>
                                TASC is built on the Bitcoin open source code. This guaranties complete security and
                                transparency of any transactions that have become available thanks to the blockchain
                                technology and cryptocurrencies.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="c-crypto-chat">
            <div class="container">
                <div
                    style="height:433px; background-color: #1D2330; overflow:hidden; box-sizing: border-box; border: 1px solid #282E3B; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #262B38; padding: 0px; margin: 0px; width: 100%;">
                    <div style="height:413px; padding:0px; margin:0px; width: 100%;"><iframe
                            src="https://widget.coinlib.io/widget?type=full_v2&theme=dark&cnt=6&pref_coin_id=1505&graph=yes"
                            width="100%" height="409px" scrolling="auto" marginwidth="0" marginheight="0"
                            frameborder="0" border="0" style="border:0;margin:0;padding:0;"></iframe></div>
                    <div
                        style="color: #626B7F; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;">
                        <a href="https://coinlib.io" target="_blank"
                            style="font-weight: 500; color: #626B7F; text-decoration:none; font-size:11px">Cryptocurrency
                            Prices</a>&nbsp;by Coinlib</div>
                </div>
            </div>
        </section>
        <section class="c-features">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-sm-6 col-md-3">
                        <div class="c-benefit shadow-sm" data-aos="fade-up">
                            <i class="c-benefit__icon fa fa-user-plus fa-4x mb-3"></i>
                            <h5 class="c-benefit__title">
                                Create an account
                            </h5>
                            <p class="c-benefit__info">
                                To register you only need to fill in the registration form and if you have been referred
                                to us, the registration is free
                            </p>

                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">

                        <div class="c-benefit shadow-sm" data-aos="fade-up">
                            <i class="c-benefit__icon fa fa-money fa-4x mb-3"></i>
                            <h5 class="c-benefit__title">
                                Select Amount
                            </h5>
                            <p class="c-benefit__info">
                                Once inside your administration panel, click on deposit to select your preferred
                                investment plan and deposit the amount starting from $100
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="c-benefit shadow-sm" data-aos="fade-up">
                            <i class="c-benefit__icon fa fa-handshake-o fa-4x mb-3"></i>
                            <h5 class="c-benefit__title">
                                Start Making Profits
                            </h5>
                            <p class="c-benefit__info">
                                From the first moment you will begin to receive daily profits in your account.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="c-benefit c-benefit--main">
                            <h5 class="c-benefit__title">
                                How to get started
                            </h5>
                            <p class="c-benefit__info">
                                Trading on TASC is simple and easy to start
                            </p>
                            <a href="{{url('register')}}" class="btn c-benefit__invest-btn px-5">Start Trading <i
                                    class="fa fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection