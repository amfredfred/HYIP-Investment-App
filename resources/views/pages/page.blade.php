@section('title')
<title>{{ucfirst($settings['site_name'])}} - {{$page->title}}</title>
<meta  name="description" content="Privacy Policy">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - {{$page->title}}"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('content')
<div class="page_header" data-parallax-bg-image="{{asset('frontend/assets/img/1920x650-5.jpg')}}" data-parallax-direction="">
            <div class="header-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="haeder-text">
                                <h1>{{$page->title}}</h1>
                             
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  /.End of page header -->
        <div class="about_content">
            <div class="container">
                <div class="row about-text justify-content">
                          {!! $page->description !!}
                    
                </div>
            </div>
        </div>
<!--body content start-->


    @endsection