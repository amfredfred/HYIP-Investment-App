
@section('title')
<title>{{ucfirst($settings['site_name'])}} - Reset Password</title>
<meta  name="description" content="Reset Password">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Reset Password"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
<link href="reg-log/css/style.css" rel="stylesheet" type="text/css" media="all" />
@endsection
@extends('layouts.app')
@section('headerText')
<div class="header__cta-text text-center" data-aos="fade-up">
    <div class="col-md-6 col-sm-8 m-auto">
        <h3 class="mb-0">
            Reset Password
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
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('confirm') }}">
                        @csrf
                        <div class="form-group"> 
                            <input type=text name='email' value="{{ $email ?? old('email') }}" class="form-control form-input @error('email') is-invalid @enderror" placeholder="Type your e-mail" required="required" >
                            <i class="input__icon  fa fa-envelope"></i>
                            @error('email')
                            <span class="help-block text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group"> 
                            <input type=password name='password'  class="form-control form-input @error('password') is-invalid @enderror" placeholder="Password" required="required" >
                            <i class="input__icon  fa fa-unlock-alt"></i>
                            @error('password')
                            <span class="help-block text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group"> 
                            <input type=password name='password_confirmation'  class="form-control form-input " placeholder="Confirm Password" required="required" >
                            <i class="input__icon  fa fa-unlock-alt"></i>
                        </div>

                        <br/>
                        <div class="form-group">
                            <button class="btn btn-primary px-5 py-2 mb-3">Reset Password</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
