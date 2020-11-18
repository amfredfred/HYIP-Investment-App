@section('title')
<title>{{ucfirst($settings['site_name'])}} - Login</title>
<meta  name="description" content="Login">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Login"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
<link href="reg-log/css/style.css" rel="stylesheet" type="text/css" media="all" />
@endsection
@extends('layouts.app')
@section('headerText')
<div class="header__cta-text text-center" data-aos="fade-up">
    <div class="col-md-6 col-sm-8 m-auto">
        <h3 class="mb-0">
            Please Login
        </h3>

    </div>
</div>
@endsection
@section('content')



<main>
    <section class="c-login">
        <div class="">
            <div class=" c-login__form">
                <div class="col-md-5 col-sm-7 m-auto p-md-5 p-3 c-login__the-form rounded" data-aos="fade-up">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control form-input">
                            <i class="input__icon fa fa-envelope"></i>
                              @error('email')
                    <span class="help-block text-danger text-center">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                        </div>
                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control form-input">
                            <i class="input__icon fa fa-key"></i><br>
                              @error('password')
                    <span class="help-block text-danger text-center">
                        <strong>{{ $message }}</strong>
                    </span>
                              <br/>
                    @enderror
                            <a href="{{route('password.request')}}">Forgot password?</a>
                        </div>
                        <div class="custom-control custom-checkbox mb-4">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Remember me</label>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary px-5 py-2 mb-3">Log In</button> <a href="{{route('register')}}"
                                                                                              class="btn"> Create
                                Account</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
