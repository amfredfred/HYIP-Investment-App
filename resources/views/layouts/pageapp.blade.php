<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" />
<head>
    <meta name="viewport" content="width=1024" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link rel="icon" href="{{asset('logo/logo.png')}}">
    <link rel="shortcut icon" href="{{asset('logo/logo.png')}}">
    <link rel="apple-touch-icon"   href="{{asset('logo/logo.png')}}">
    <link rel="apple-touch-icon"  href="{{asset('logo/logo.png')}}">
    <link rel="apple-touch-icon"  href="{{asset('logo/logo.png')}}">
    <link rel="apple-touch-icon"  href="{{asset('logo/logo.png')}}">
    @yield('title')
    <!--== bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!--== animate -->
    <link href="{{asset('css/animate.css')}}" rel="stylesheet" type="text/css" />

    <!--== fontawesome -->
    <link href="{{asset('css/fontawesome-all.css')}}" rel="stylesheet" type="text/css" />

    <!--== themify -->
    <link href="{{asset('css/themify-icons.css')}}" rel="stylesheet" type="text/css" />

    <!--== lightgallery -->
    <link href="{{asset('css/lightgallery/lightgallery.css')}}" rel="stylesheet" type="text/css" />

    <!--== audioplayer -->
    <link href="{{asset('css/lightgallery/audioplayer.css')}}" rel="stylesheet" type="text/css" />

    <!--== magnific-popup -->
    <link href="{{asset('css/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css" />

    <!--== owl-carousel -->
    <link href="{{asset('css/owl-carousel/owl.carousel.css')}}" rel="stylesheet" type="text/css" />

    <!--== slit-slider -->
    <link href="{{asset('css/slit-slider/slit-slider.css')}}" rel="stylesheet" type="text/css" />

    <!--== slick-slider -->
    <link href="{{asset('css/slick-slider/slick.css')}}" rel="stylesheet" type="text/css" />

    <!--== base -->
    <link href="{{asset('css/base.css')}}" rel="stylesheet" type="text/css" />

    <!--== shortcodes -->
    <link href="{{asset('css/shortcodes.css')}}" rel="stylesheet" type="text/css" />

    <!--== default-theme -->
    <link href="{{asset('css/default-theme.css')}}" rel="stylesheet" type="text/css" />

    <!--== responsive -->
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet" type="text/css" />

    <!--== color-customizer -->
    <link href="#" data-style="styles" rel="stylesheet">
    <link href="{{asset('css/color-customize/color-customizer.css')}}" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css?family=Ubuntu:400,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <style>

        /*contentBot*/
        .contentBotContainer {
            width: 100%;
            background: #d84f1d
        }
        .contentBotInner {
            width: 1170px;
            margin: 0 auto;
            padding: 30px 0;
            background: url(images/bg3.html) transparent no-repeat center;
            background-size: cover;
        }
        .content-bot-part {
            border-radius: 3px;
            background: #eeeff0;
            padding: 15px;
        }
        .content-bot-part h3 {
            line-height: 39px;
            text-align: center;
            border-radius: 3px;
            background: #ff4500;
            font-size: 18px;
            color: #ffffff;
            font-family: 'Open Sans', sans-serif;
            font-weight: 300;
            text-transform: uppercase;
            margin: 0;
            margin-bottom: 15px;
        }
        .content-bot-part table {
            margin: 0;
        }
        .content-bot-part table tr:nth-child(odd) td {
            background: #d0d3d5;
        }
        .content-bot-part table tr:nth-child(even) td {
            background: #dbdfe3;
        }
        .content-bot-part2 {
            margin: 0 2%;
        }


        /* ======= PRICING ======= */



        .bs-pricing-four {
            font-size: 16px;
            font-family: 'Open Sans', sans-serif;
        }
        .bs-pricing {
            background:#fff;
        }
        .bs-pricing-four .btn,
        .bs-pricing-four .navbar > li > a.btn {
            border: none;
            border-radius: 3px;
            position: relative;
            padding: 12px 30px;
            margin: 10px 1px;
            font-size: 12px;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0;
            will-change: box-shadow, transform;
            transition: box-shadow 0.2s cubic-bezier(0.4, 0, 1, 1), background-color 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .bs-pricing-four .btn {
            border-radius: 30px;
        }





        /* btn-danger */
        .bs-pricing-four .btn.btn-danger {
            color: #FFFFFF;
            background-color: #f44336;
            border-color: #f44336;
            box-shadow: 0 2px 2px 0 rgba(244, 67, 54, 0.14), 0 3px 1px -2px rgba(244, 67, 54, 0.2), 0 1px 5px 0 rgba(244, 67, 54, 0.12);
        }

        .bs-pricing-four .btn.btn-danger:focus,
        .bs-pricing-four .btn.btn-danger:active,
        .bs-pricing-four .btn.btn-danger:hover {
            box-shadow: 0 14px 26px -12px rgba(244, 67, 54, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(244, 67, 54, 0.2);
        }


        /* btn-success */
        .bs-pricing-four .btn.btn-success {
            color: #FFFFFF;
            background-color: #4caf50;
            border-color: #4caf50;
            box-shadow: 0 2px 2px 0 rgba(76, 175, 80, 0.14), 0 3px 1px -2px rgba(76, 175, 80, 0.2), 0 1px 5px 0 rgba(76, 175, 80, 0.12);
        }

        .bs-pricing-four .btn.btn-success:focus,
        .bs-pricing-four .btn.btn-success:active,
        .bs-pricing-four .btn.btn-success:hover {
            box-shadow: 0 14px 26px -12px rgba(76, 175, 80, 0.42), 0 4px 23px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(76, 175, 80, 0.2);
        }




        /* btn-white */
        .bs-pricing-four .btn.btn-white {
            color: #3C4857;
            background-color: #fff;
            border-color: #fff;
            box-shadow: 0 2px 2px 0 rgba(153, 153, 153, 0.14), 0 3px 1px -2px rgba(153, 153, 153, 0.2), 0 1px 5px 0 rgba(153, 153, 153, 0.12);
        }

        .bs-pricing-four .btn.btn-white:focus,
        .bs-pricing-four .btn.btn-white:active,
        .bs-pricing-four .btn.btn-white:hover {
            box-shadow:  0 14px 26px -12px rgba(255, 255, 255, 0.42), 0 4px 23px 0px rgba(255, 255, 255, 0.12), 0 8px 10px -5px rgba(255, 255, 255, 0.2)
        }








        .bs-pricing-four .bs {
            display: inline-block;
            position: relative;
            width: 100%;
            margin-bottom: 30px;
            border-radius: 6px;
            color: #444;
            box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
        }

        .bs-pricing-four .bs.bs-background-img{
            background: url(images/pricing-bg-image.html) no-repeat center center;
            background-size: cover;
            position: relative;
            -webkit-filter: grayscale(100%);
            filter: grayscale(100%);
            transition: all 1s;
        }
        .bs-pricing-four .bs.bs-background-img:hover{
            -webkit-filter: grayscale(0%);
            filter: grayscale(0%);
        }
        .bs-pricing-four .bs-background-img,
        .bs-pricing-four .bs-background-img h1 small{
            color:#fff ;
        }
        .bg-danger{background-color: #f44336}

        .bs-pricing-four .bg-danger,
        .bs-pricing-four .bg-danger h1 small
        {
            color:#fff;
        }


        .bs-pricing-four .bs-background-img:after {
            position: absolute;
            z-index: 1;
            width: 100%;
            height: 100%;
            display: bs;
            left: 0;
            top: 0;
            content: "";
            background-color: rgba(0, 0, 0, 0.56);
            border-radius: 6px;
        }

        .bs-pricing-four .bs-pricing {
            text-align: center;
            position: relative;
        }

        .bs-pricing-four .bs-pricing .bs-caption {
            margin-top: 30px;
        }

        .bs-pricing-four .bs-pricing .cotent {
            padding: 15px;
            margin-bottom: 0px;
            z-index: 2;
            position: relative;
        }



        .bs-pricing-four .bs-pricing ul {
            list-style: none;
            padding: 0;
            margin: 10px auto;

        }

        .bs-pricing-four .bs-pricing ul li {
            text-align: center;
            padding: 12px 0;
        }
        .bs-pricing-four .bs-pricing ul:not(.nav-pills) li{
            border-bottom: 1px solid rgba(153, 153, 153, 0.3);
        }

        .input-group {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-align: stretch;
            align-items: stretch;
            width: 100%;
        }

        .input-group>.form-control:not(:last-child), .input-group>.custom-select:not(:last-child) {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }
        .input-group>.form-control, .input-group>.form-control-plaintext, .input-group>.custom-select, .input-group>.custom-file {
            position: relative;
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            width: 1%;
            margin-bottom: 0;
        }
        .border-dark {
            border-color: #343a40 !important;
        }

        .input-group-append {
            margin-left: -1px;
        }
        .input-group-prepend, .input-group-append {
            display: -ms-flexbox;
            display: flex;
        }


        .well-services {
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
            z-index: 1;
            background: #fff;
        }
        .top-icon {
            position: absolute;
            right: 15px;
            font-size: 44px;
            bottom: 0px;
            background: #ef3205;
            width: 60px;
            height: 60px;
            line-height: 60px;
            text-align: center;
            color: #fff;
            border-radius: 5px 5px 0px 0px;
            z-index: 9;
        }
        .main-services {
            display: block;
            overflow: hidden;
            padding: 20px;
            position: relative;
            z-index: 1;
        }
        .well-icon {
            width: 60px;
            float: left;
            height: 100px;
            font-size: 40px;
            color: #80c32f;
        }
        .services-img {
            overflow: hidden;
            position: relative;
            text-align: center;
        }
        .services-img img {
            transform: scale(1.1);
            transition: 0.4s;
        }
        .image-layer {
            position: absolute;
            left: 0;
            top: 100%;
            width: 100%;
            height: 100%;
            background: rgba(0,44,87,0.95) none repeat scroll 0 0;
            z-index: 1;
            opacity: 1;
            transition: 0.4s;
            padding: 30px 20px;
        }
        .image-layer a {
            display: block;
            text-align: left;
            position: relative;
            margin-bottom: 10px;
            color: #fff;
            font-size: 14px;
        }
        .image-layer a i {
            border-radius: 50%;
            background: transparent;
            font-size: 20px;
            opacity: 0.90;
            line-height: 30px;
            margin-right: 15px;
        }
        .service-content h4 {
            display: inline-block;
            font-size: 16px;
            font-weight: 700;
            margin-bottom: 0;
            padding: 0 0 10px;
            text-transform: uppercase;
        }
        .service-btn {
            font-weight: 700;
            text-transform: uppercase;
            color: #444;
            position: relative;
            font-family: 'Montserrat', sans-serif;
            font-size: 13px;
            z-index: 2;
        }
        .service-btn::after {
            position: absolute;
            content: "\f105";
            font-family: fontAwesome;
            right: -15px;
            top: -5px;
            font-size: 16px;
        }
        .well-services:hover .services-img img {
            transform: scale(1);
            transition: 0.4s;
        }
        .well-services:hover .image-layer {
            position: absolute;
            left: 0;
            top: 0;
            transition: 0.4s;
        }
        .well-services:hover .service-content h4{
            color: #80c32f;
        }
        .well-services:hover .service-btn:hover{
            color: #80c32f;
        }
        .image-layer a:hover{
            color: #80c32f;
        }

        .carousel-item {
            min-height: 650px;
            background: no-repeat center center scroll;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }
    </style>

</head>

<body>

<body style="font-family: 'Ubuntu', sans-serif !important;">

    <!--page wrapper start-->

    <div class="page-wrapper">

        @include('layouts.nav')
        @yield('content')
        @include('layouts.footer')


    <div id="scroll-top"><a class="top arrow" href="#top"><i class="ti-arrow-up"></i></a></div>
    </div>


    <!--== jquery -->
    <script src="{{asset('js/jquery.3.3.1.min.js')}}"></script>

    <!--== popper -->
    <script src="{{asset('js/popper.min.js')}}"></script>

    <!--== bootstrap -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>

    <!--== jquery appear -->
    <script src="{{asset('js/jquery.appear.js')}}"></script> 

    <!--== jquery easing -->
    <script src="{{asset('js/jquery.easing.min.js')}}"></script>

    <!--== modernizr -->
    <script src="{{asset('js/modernizr.js')}}"></script> 

    <!--== menu -->
    <script src="{{asset('js/menu/jquery.smartmenus.js')}}"></script>

    <!--== lightgallery -->
    <script src="{{asset('js/lightgallery/lightgallery.js')}}"></script> 

    <!--== audioplayer -->
    <script src="{{asset('js/lightgallery/audioplayer.js')}}"></script>

    <!--== magnific-popup -->
    <script src="{{asset('js/magnific-popup/jquery.magnific-popup.min.js')}}"></script> 

    <!--== owl-carousel -->
    <script src="{{asset('js/owl-carousel/owl.carousel.min.js')}}"></script> 

    <!--== slit-slider -->
    <script src="{{asset('js/slit-slider/jquery.ba-cond.min.js')}}"></script>
    <script src="{{asset('js/slit-slider/jquery.slitslider.js')}}"></script>

    <!--== slick-slider -->
    <script src="{{asset('js/slick-slider/slick.js')}}"></script>

    <!--== jarallax -->
    <script src="{{asset('js/jarallax/jarallax.min.js')}}"></script> 

    <!--== counter -->
    <script src="{{asset('js/counter/counter.js')}}"></script> 

    <!--== countdown -->
    <script src="{{asset('js/countdown/jquery.countdown.min.js')}}"></script> 

    <!--== isotope -->
    <script src="{{asset('js/isotope/isotope.pkgd.min.js')}}"></script> 

    <!--== contact-form -->
    <script src="{{asset('js/contact-form/contact-form.js')}}"></script>

    <!--== validate -->
    <script src="{{asset('js/contact-form/jquery.validate.min.js')}}"></script>

    <!--== map api -->
    <script src="https://maps.googleapis.com/maps/api/js"></script>

    <!--== map -->
    <script src="{{asset('js/map.js')}}"></script>

    <!--== typer -->
    <script src="{{asset('js/typer/typer.js')}}"></script>

    <!--== color-customizer -->
    <script src="{{asset('js/color-customize/color-customizer.js')}}"></script> 

    <!--== theme-script -->
    <script src="{{asset('js/theme-script.js')}}"></script>
    @yield('script')
</body>
</html>
