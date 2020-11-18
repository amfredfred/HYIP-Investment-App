@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Registration Success</title>
<meta  name="description" content="Registration Success">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Registration Success"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.home')
@section('content')
<section class="page-title o-hidden" data-overlay="7" data-bg-img="{{asset('images/bg/02.jpeg')}}" style="background-image: url({{url('images/bg/02.jpeg')}});">
 <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 col-md-12">
        
<h1>Registration <span class="text-theme">completed</span></h1>
        <p>After Registration </p>
      </div>
      <div class="col-lg-6 col-md-12 text-lg-right md-mt-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb breadcrumb-4 justify-content-end">
            <li class="breadcrumb-item"><a href="{{url('/')}}"><i class="fas fa-home"></i></a>
            </li>
            <li class="breadcrumb-item"><a href="#">Pages</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">after register</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>

<!--page title end-->


<!--body content start-->

<div class="page-content">

<!--terms start-->

<section>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h2 class="title-2">Registration <span>Completed</span></h2>


<br>
<br>
Thank you for joining our program.<br>
You are now an official member of this program. You can go to your dashboard by clicking <a href="{{url('home')}}">here</a> to  start investing with us and use all the services that are available for our members.
<br>
<br>

<b>Important:</b> Do not provide your login and password to anyone!
</div>
</div>
</div>
</section>
@endsection
