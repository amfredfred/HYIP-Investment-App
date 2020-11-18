@section('title')
<title>{{ucfirst($settings['site_name'])}}</title>
<meta  name="description" content="{{ucfirst($settings['site_name'])}}">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}}"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

<style>
   
    @if(!empty($homepage->about_us_photo))
    .c-about-us {
        padding: 7rem 0;
        background-image: url({{url($homepage->about_us_photo)}});

    }
    @endif
    @if(!empty($homepage->get_start_text_image))
    .c-what-we-do {
    background:linear-gradient(128.47deg, hsla(346, 86%, 54%, .7) 14.1%, rgba(239, 35, 133, 0.7) 76.95%), url({{url($homepage->get_start_text_image)}});
  
    }
    @endif
    @if(!empty($homepage->why_us_text_image))
    .c-why-us{  
        background-image: url({{url($homepage->why_us_text_image)}});
    }
    @endif
 
</style>

@endsection
@extends('layouts.app')
@section('headerText')
<div class="header__cta-text text-center "   data-aos="fade-up">
    <div class="col-md-6 col-sm-8 m-auto">
        <h1>
            {!! $homepage['title'] !!}
        </h1>
        <p class="mt-4">
            {!! $homepage['description'] !!}
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
                                @if(!empty($about))
                                {!! $about->getAbout() !!}
                                @endif
                            </p>
                            <a href="{{url('pages/about-us')}}" class="c-link">Learn More >></a>
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

                    <iframe width="100%" height="315" src=" {{asset($settings['video_1'])}}"
                            frameborder="0"
                            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                </div>
                <div class="col-md-5">
                    {!! $homepage['video_text'] !!}

                </div>
            </div>
        </div>
    </section>
    <style>
       
    </style>
    <section class="c-what-we-do ">
        <div class="container-fluid">
            <div class="text-center col-sm-8 col-md-6 m-auto" data-aos="fade-up">
                <h3 class=''>
                    {!! $homepage['get_beneift_text'] !!}
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
                        {!! $homepage['benefit_text'] !!}

                        <a href="{{url('register')}}" class="btn c-benefit__invest-btn px-5">Invest Now <i
                                class="fa fa-angle-right"></i></a>
                    </div>
                </div>
                @foreach($benefits as $benefit)
                <div class="col-sm-6 col-md-3">

                    <div class="c-benefit shadow-sm" data-aos="fade-up">
                        <i class="c-benefit__icon {!! $benefit->icon !!} fa-4x mb-3"></i>
                        <h5 class="c-benefit__title">
                            {!! $benefit->title !!}
                        </h5>
                        <p class="c-benefit__info">
                            {!! $benefit->description !!}
                        </p>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <section class="c-why-us">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 mb-4">
                    <div class="c-why-us__text p-5 rounded" data-aos="fade-up">
                        <span>
                            <h2> Why Invest With Us?</h2>
                        </span>
                        {!! $homepage['why_us_text'] !!}

                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <section class="c-features">
        <div class="container-fluid">
            <div class="row justify-content-center">
                    <div class="col-sm-6 col-md-3">
                    <div class="c-benefit c-benefit--main">
                        {!! $homepage['get_start_text'] !!}


                        <a href="{{url('register')}}" class="btn c-benefit__invest-btn px-5">Start Investing</a>
                    </div>
                </div>
                @foreach($get_started as $get_start)
                <div class="col-sm-6 col-md-3">
                    <div class="c-benefit shadow-sm" data-aos="fade-up">
                        <i class="c-benefit__icon {!! $get_start->icon !!}  fa-4x mb-3"></i>
                        <h5 class="c-benefit__title">
                            {!! $get_start->title!!}
                        </h5>
                        <p class="c-benefit__info">
                            {!! $get_start->description !!}
                        </p>

                    </div>
                </div>
                @endforeach
            
            </div>
        </div>
    </section>
</main>

@endsection