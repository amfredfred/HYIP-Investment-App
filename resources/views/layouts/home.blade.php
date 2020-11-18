<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" />
<head>
      <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link rel="icon" href="{{asset($settings['favicon']) }}">
    <link rel="shortcut icon" href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"   href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
    <link rel="apple-touch-icon"  href="{{asset($settings['favicon']) }}">
        <script>
        window.user = '{{Auth::user()->type}}';
    </script>
    @yield('title')
	   <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/icons/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/aos.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/dashboard.css')}}">
	@if($color =='white')
    <link rel="stylesheet" href="{{asset('assets/css/light-theme.css')}}">
@elseif($color =='dark')
 <link rel="stylesheet" href="{{asset('assets/css/dark-theme.css')}}">
@else
	 <link rel="stylesheet" href="{{asset('assets/css/light-theme.css')}}">
 @endif
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital@1&display=swap" rel="stylesheet">

 <link href="{{ asset('assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />

      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />

 <link href="{{ asset('assets/plugins/sweetalert/sweetalert.css')}}" rel="stylesheet" />
</head>

<body>
    @yield('content')




<script src="{{asset('js/app.js')}}"></script>

    <script src="{{ asset('assets/js/aos.js')}}"></script>
    <script src="{{ asset('assets/js/main.js')}}"></script>


    <!--== theme-script -->
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
        <script>
            $('#myModal').appendTo("body").modal('show');
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
         confirmButtonColor: "#0000cc"
    }).then((value) => {
        //location.reload();
    }).catch(swal.noop);
</script>

@endif
    @yield('script')

</body>
</html>
