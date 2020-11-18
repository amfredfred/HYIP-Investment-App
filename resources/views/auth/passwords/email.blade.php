

@section('title')
<title>{{ucfirst($settings['site_name'])}} - Forgot Password</title>
<meta  name="description" content="Forgot Password">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Forgot Password"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
<link href="reg-log/css/style.css" rel="stylesheet" type="text/css" media="all" />
@endsection
@extends('layouts.app')
@section('headerText')
<div class="header__cta-text text-center" data-aos="fade-up">
    <div class="col-md-6 col-sm-8 m-auto">
        <h3 class="mb-0">
            Forgot Password
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

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <input type=text name=email value='{{ old('email') }}' class="form-control @error('email') is-invalid @enderror" size=30 autofocus="autofocus" placeholder="Email">
                        @error('email')
                        <span class="help-block text-danger text-center">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <br/>
                        <div class="form-group">
                            <button class="btn btn-primary px-5 py-2 mb-3">Forgot</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
