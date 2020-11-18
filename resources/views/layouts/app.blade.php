<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" />
<head>
      <meta charset="UTF-8">
<meta name="viewport" content="width=1024" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link rel="icon" href="{{asset($settings['favicon']) }}">
    <link rel="shortcut icon" href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"   href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    @yield('title')
	   <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/icons/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
   

 <link href="{{ asset('assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

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
@if(!empty($homepage->photo))
    .header.header--homepage {
        background-image:  url({{url($homepage->photo)}}); 

    }
    @endif
    .overlay{
        background-color: rgba(0, 0, 0, 0.5);
    }

@if(!empty($settings->img_login_register))
    .c-login  {
        background-image:  url({{url($settings->img_login_register)}}); 

    }
    @endif
    </style>

 <link href="{{ asset('assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
</head>


<body>
  
       
       @include('layouts.nav')
       
        @yield('content')
          <div class="modal" style="display: none">
                <div class="mcenter">
                    <img src="{{asset('images/reload.gif')}}"  >
                </div>
            </div>
       
          @include('layouts.footer')
    
     
 <script type="text/javascript">
function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
 <script src="{{ asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('assets/js/aos.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>
	
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
     <script src="{{ asset('assets/plugins/sweetalert/sweetalert.min.js')}}"></script>
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
    @yield('script')
</body>
</html>
