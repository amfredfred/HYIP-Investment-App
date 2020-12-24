<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link rel="icon" href="{{asset($settings['favicon']) }}">
    <link rel="shortcut icon" href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"   href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    @yield('title')
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nanum+Myeongjo:400,700,800" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800,900" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> 

    <!-- Global css -->
    <link href="{{ asset('frontend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/bootsnav.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/owl.theme.default.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/bootstrap-select.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/flag-icons/css/flag-icon.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/linearicons.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/animate.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/magnific-popup.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/dataTables.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/responsive.bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/amcharts/export.css')}}" rel="stylesheet">
    <!-- style css -->
    <link href="{{ asset('frontend/assets/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <style>

        @media only screen and (max-width: 992px) {


            .toast-top-right {
                min-width: 250px!important;
                margin-left: -125px!important;
                text-align: center!important;
                border-radius: 2px!important;
                padding: 16px!important;
                position: fixed!important;
                z-index: 1!important;
                left: 50%!important;
                top: 50%!important;
                bottom: 30px!important;
                font-size: 17px!important;
                -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
                animation: fadein 0.5s, fadeout 0.5s 2.5s;
            }
        }
        @media only screen and (min-width: 993px) {
            .toast-top-right {
                min-width: 250px!important;
                margin-left: -125px!important;
                text-align: center!important;
                border-radius: 2px!important;
                padding: 16px!important;
                position: fixed!important;
                z-index: 1!important;
                left: 50%!important;
                top: 40%!important;
                bottom: 30px!important;
                font-size: 17px!important;
                -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
                animation: fadein 0.5s, fadeout 0.5s 2.5s;
            }   
        }


        .toast {
            opacity: 0.9!important;
        }
        :root {
            --wpcargo: #00A924;
        }
        .modal
        {
            position: fixed;
            z-index: 999;
            height: 100%;
            width: 100%;
            top: 0;
            left: 0;
            background-color: Black;
            filter: alpha(opacity=60);
            opacity: 0.6;
            -moz-opacity: 0.8;
        }
        .mcenter
        {
            z-index: 1000;
            margin: 300px auto;
            padding: 10px;
            width: 130px;
            background-color: White;
            border-radius: 10px;
            filter: alpha(opacity=100);
            opacity: 1;
            -moz-opacity: 1;
        }
        .mcenter img
        {
            height: 100px;
            width: 100px;
        }


        .ca{
            box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23);
        }

    </style>

</head>

<body>
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

    @include('layouts.nav')

    @yield('content')
    @include('layouts.footer')


    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
        }
    </script>
    <script>
        var flags = document.getElementsByClassName('flag_link');
        Array.prototype.forEach.call(flags, function (e) {
            e.addEventListener('change', function () {
                var lang = $(this).val();
                var languageSelect = document.querySelector("select.goog-te-combo");
                languageSelect.value = lang;
                languageSelect.dispatchEvent(new Event("change"));
            });
        });
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="{{ asset('frontend/assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/bootsnav.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/parallax-background.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/responsive.bootstrap.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.marquee.min.js')}}" ></script>
    <script src="{{ asset('frontend/assets/js/particles.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/app.js')}}"></script>
    <script src="{{ asset('frontend/assets/js/custom.js')}}"></script>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        $(".deleted").on("submit", function () {

            return confirm("Are you sure?");
        });
    </script>

    <script>
        $(".deleted-list").on("submit", function () {

            return confirm("Are you sure?");
        });
    </script>
    {!! $settings['chat_script'] !!}
    @if(session()->has('message.level'))
    <script type="text/javascript">
        swal({
            title: "{{ session('message.level') }}",
            html: true,
            text: "<span style='color:{{ session('message.color') }};font-size:20px;margin:10px'>{!! session('message.content') !!}",
            timer: 10000,
            type: "{{ session('message.level') }}",
            confirmButtonColor: "#007bff"
        }).then((value) => {
            //location.reload();
        }).catch(swal.noop);
    </script>

    @endif
      @if(session()->has('message.level'))
    <script type="text/javascript">
        var message = "{!! session('message.content') !!}";
        @if (session('message.level') == 'error')
        toastr.error(message, {timeOut: 50000});
                @else
       toastr.success(message, {timeOut: 50000});
        @endif

    </script>

    @endif
    @yield('script')
</body>
</html>
