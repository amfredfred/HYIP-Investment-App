@section('title')
<title>{{ucfirst($settings['site_name'])}} - Verification</title>
<meta  name="description" content="Verification">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Verification"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
<link href="reg-log/css/style.css" rel="stylesheet" type="text/css" media="all" />
@endsection
@extends('layouts.app')
@section('headerText')
<div class="header__cta-text text-center" data-aos="fade-up">
    <div class="col-md-6 col-sm-8 m-auto">
        <h3 class="mb-0">
            Please Verify your Account
        </h3>

    </div>
</div>
@endsection
@section('content')
<style>
    .c-verify {
  background-image: url({{url('assets/images/man-in-blue-suit-999267.jpg')}});
  background-size: cover;
  background-repeat: no-repeat;
  margin-top: 0; }
  .c-verify .c-verify__form {
    background-color: #3955d1;
    padding: 5rem 2rem; }
    @media screen and (min-width: 768px) {
      .c-verify.c-verify__form {
        padding: 10rem 5rem; } }
    .c-verify .c-verify__form .c-verify__the-form {
      background-color: #fdfffc; }
   
</style>

<main>
    <section class="c-login">
        <div class="">
            <div class=" c-login__form">
                <div class="col-md-5 col-sm-7 m-auto p-md-5 p-3 c-login__the-form rounded" data-aos="fade-up">
                    <form method="POST" action="{{ route('verify_account') }}">
                        @csrf
                        <small class="text-danger"> {{ __('Before proceeding, please check your email for a verification Code.') }}</small>
                        <br/>
                        <div class="form-group">
                            <label for="code" class="form-label">Enter Verification Code</label>
                            <input type="text" name="code" id="code" class="form-control form-input">
                           
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary px-5 py-2 mb-3">Verify</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

@endsection
