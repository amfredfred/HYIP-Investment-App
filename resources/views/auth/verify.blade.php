@section('title')
<title>{{ucfirst($settings['site_name'])}} - Verification</title>
<meta  name="description" content="Verification">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Verification"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
<link href="reg-log/css/style.css" rel="stylesheet" type="text/css" media="all" />
@endsection
@extends('layouts.app')
@section('content')

@section('content')
<div class="page_header" data-parallax-bg-image="{{asset('frontend/assets/img/1920x650-5.jpg')}}" data-parallax-direction="">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="haeder-text">
                        <h1>  Create New Account</h1>

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
                        <form method="POST" action="{{ route('verify_account') }}">
                        @csrf
                          <div class="alert alert-danger" role="alert">
                                <strong>  <small> {{ __('Before proceeding, please check your email for a verification Code.') }}</small>
                      </strong>
                            </div>
                        <br/>
                        <span class="input">
                            <input class="input__field" type="number" name="code" id="code">
                            <label class="input__label" for="input-1">
                                <span class="input__label-content" data-content="Verification Code">Verification Code</span>
                            </label>
                        </span>
                       

                        <div class="form-group">
                            <button class="btn btn-reg">Verify</button>
                        </div>
              </form>
                </div> 
            </div>
        </div>
    </div>
</div>


@endsection
