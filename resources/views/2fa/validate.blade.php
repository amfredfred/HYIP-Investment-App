
@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; One-Time Password</title>
<meta  name="description" content="One-Time Password">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - One-Time Password"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
<link href="reg-log/css/style.css" rel="stylesheet" type="text/css" media="all" />
@endsection
@extends('layouts.app')
@section('headerText')
<div class="header__cta-text text-center" data-aos="fade-up">
    <div class="col-md-6 col-sm-8 m-auto">
        <h3 class="mb-0">
            One-Time Password
        </h3>

    </div>
</div>
@endsection
@section('content')



<main>
    <section class="c-login">
        <div class="">
            <div class="col-md-6 col-sm-8 c-login__form">
                <div class="col-md-9 m-auto p-md-5 p-3 c-login__the-form rounded" data-aos="fade-up">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form method="POST" action="/2fa/validate">
                        @csrf
                        <div class="form-group"> 
                            @if(session()->has('message.level'))
                            {!! session('message.content') !!}

                            @endif
                            <label for="email" class="form-label">Enter One-Time Password</label>
                            <input type=text name="totp" value="{{ $totp ?? old('totp') }}" class="form-control form-input @error('totp') is-invalid @enderror" required="required" >
                            <i class="input__icon fa fa-key"></i>
                            @error('totp')
                            <span class="help-block text-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <br/>
                        <div class="form-group">
                            <button class="btn btn-primary px-5 py-2 mb-3">Validate</button> 
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
