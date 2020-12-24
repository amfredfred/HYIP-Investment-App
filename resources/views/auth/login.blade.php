@section('title')
<title>{{ucfirst($settings['site_name'])}} - Login</title>
<meta  name="description" content="Login">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Login"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
<link href="reg-log/css/style.css" rel="stylesheet" type="text/css" media="all" />
@endsection
@extends('layouts.app')
@section('content')
<div class="page_header" data-parallax-bg-image="{{asset('frontend/assets/img/1920x650-5.jpg')}}" data-parallax-direction="">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="haeder-text">
                        <h1>  Login into your  Account</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="reg-wrapper">
    <div class="about_content">
        <div class="container">
            <div class="row">
                <div class="col-md-7 col-md-offset-3">
                    <form method="POST" action="{{ route('login') }}">

                        @csrf
                        <span class="input">
                            <input class="input__field" name="email" type="email" id="email">
                            <label class="input__label" for="input-1">
                                <span class="input__label-content"  data-content="Email">Email</span>
                            </label>
                            @error('email')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </span>

                        <span class="input">
                            <input class="input__field" name="password" type="password" id="password">
                            <label class="input__label" for="input-1">
                                <span class="input__label-content" data-content="Password">Password</span>
                            </label>
                            @error('password')
                            <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </span>

                        <a  class="checkbox-link"  href="{{route('password.request')}}">Forgot password?</a>

                        <button class="btn btn-reg">Log In</button> <a   class="checkbox-link"href="{{route('register')}}"> Create
                            Account</a>

                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>


@endsection
