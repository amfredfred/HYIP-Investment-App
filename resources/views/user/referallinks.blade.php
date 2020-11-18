@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Deposit History</title>
<meta  name="description" content="Deposit History">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Deposit History"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.home')
@section('content')
<section class="page-title o-hidden" data-overlay="7" data-bg-img="{{asset('images/bg/02.jpeg')}}" style="background-image: url({{url('images/bg/02.jpeg')}});">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-12">

                <h1>Referral Links</h1>
                <p><span class="text-theme">Your Referral Links</span></p>
            </div>
            <div class="col-lg-6 col-md-12 text-lg-right md-mt-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-4 justify-content-end">
                        <li class="breadcrumb-item"><a href="{{url('home')}}"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Pages</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Referral Links</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!--faq start-->
<div class="page-content">

    <section class="grey-bg" >
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10 col-xs-12">


                    <div id="dashboard">
                        <div id="sub_dashboard">


                            @can('isAdmin')

                            @include('layouts.adminlink')
                            @endcan

                            <div class="dash_head">
                                <p>Your Referral Links</p>
                            </div>

                            <div class="desh_menu">
                                <div class="desh-menu">
                                    <ul>
                                        @include('layouts.link')
                                    </ul>
                                </div>
                            </div>



                            Your Referral Link : {{url('/')}}?ref={{Auth::user()->username}}  <br><br>


                            <a href="{{url('/')}}?ref={{Auth::user()->username}}">
                                <img src="{{asset('images/banner125.jpg') }}" alt="" width="125" height="125" /><br>
                            </a>

                            <br><br>
                            <textarea class=form-control  cols=60 rows=4>
<a href="{{url('/')}}?ref={{Auth::user()->username}}">
<img src="{{asset('images/banner125.jpg') }}" alt="" width="125" height="125" /><br>
</a>
                            </textarea><br><br><br>


                            <a href="{{url('/')}}?ref={{Auth::user()->username}}">
                                <img src="{{asset('images/banner468.jpg') }}" alt="" width="468" height="60" /><br>
                            </a>

                            <br><br>
                            <textarea class=form-control  cols=60 rows=4>
<a href="{{url('/')}}?ref={{Auth::user()->username}}">
<img src="{{asset('images/banner468.jpg') }}" alt="" width="468" height="60" /><br>
</a>
                            </textarea><br><br><br>


                            <a href="{{url('/')}}?ref={{Auth::user()->username}}">
                                <img src="{{asset('images/banner728.jpg') }}" alt="" width="728" height="90" /><br></a>
                            <br><br>
                            <textarea class=form-control cols=60 rows=4>
<a href="{{url('/')}}?ref={{Auth::user()->username}}">
<img src="{{asset('images/banner728.jpg') }}" alt="" width="728" height="90" /><br>
</a>
                            </textarea><br><br><br>


                        </div>


                    </div>
                </div>
                </section>
                @endsection
