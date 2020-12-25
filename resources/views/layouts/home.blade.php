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
    <link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital@1&display=swap" rel="stylesheet">

 <link href="{{ asset('css/app.css')}}" rel="stylesheet" />


</head>

<body>
    @yield('content')




<script src="{{asset('js/manifest.js')}}"></script>
<script src="{{asset('js/vendor.js')}}"></script>
<script src="{{asset('js/app.js')}}"></script>



</body>
</html>
