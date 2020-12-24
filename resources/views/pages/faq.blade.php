@section('title')
<title>{{ucfirst($settings['site_name'])}} - FAQs</title>
<meta  name="description" content="FAQ">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - FAQs"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('headerText')

@section('content')
  <div class="page_header" data-parallax-bg-image="{{asset('frontend/assets/img/1920x650-5.jpg')}}" data-parallax-direction="">
            <div class="header-content">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2">
                            <div class="haeder-text">
                                <h1>Frequently Ask & Question</h1>
                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  /.End of page header -->
        <div class="faq_content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2">
                        <div class="">
                            <ul class="accordion">
                                  @foreach($faqs as $key=> $faq)
                                <li>
                                    <a>{!! $faq->title !!}</a>
                                    <p>    {!! $faq->description !!}</p>
                                </li>
                                @endforeach
                          
                            </ul>
                            <!-- / accordion -->
                          
                            <!-- / accordion -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

                   