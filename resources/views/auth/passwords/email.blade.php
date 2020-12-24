@section('title')
<title>{{ucfirst($settings['site_name'])}} - Forgot Password</title>
<meta  name="description" content="Forgot Password">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Forgot Password"/>
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
                        <h1>  Forgot Password</h1>

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
                      @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <span class="input">
                            <input class="input__field" name="email"  value='{{ old('email') }}' type="email" id="email">
                            <label class="input__label" for="input-1">
                                <span class="input__label-content"  data-content="Email">Email</span>
                            </label>
                            @error('email')
                             <div class="alert alert-danger" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </span>

                        <div class="form-group">
                            <button class="btn btn-reg">Submit</button> 
                        </div>
     
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>

@endsection
