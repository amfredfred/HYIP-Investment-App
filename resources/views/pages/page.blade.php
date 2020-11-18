@section('title')
<title>{{ucfirst($settings['site_name'])}} - {{$page->title}}</title>
<meta  name="description" content="Privacy Policy">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - {{$page->title}}"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('headerText')
<div class="header__cta-text text-center" data-aos="fade-up">
            <div class="col-md-6 col-sm-8 m-auto">
                <h1>
                {{$page->title}}
                </h1>

            </div>
        </div>
@endsection
@section('content')

<!--body content start-->

<div class="page-content">

<!--privacy start-->

<section class="c-privacy-policy">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h2 class="title-2">   {{$page->title}}</h2>
      </div>
    </div>
    <div class="row mt-3">
      <div class="col-lg-12 col-md-12">
           {!! $page->description !!}
      </div>
    </div>
  </div>
</section>

<!--privacy end-->

    @endsection