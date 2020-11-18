@section('title')
<title>{{ucfirst($settings['site_name'])}} - About Us</title>
<meta  name="description" content="About Us">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - About Us"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

<style>
   
    @if(!empty($homepage->about_us_photo))
    .c-about-us {
        padding: 7rem 0;
        background-image: url({{url($homepage->about_us_photo)}});

    }
    @endif
  
 
</style>
@endsection
@extends('layouts.app')
@section('headerText')
<div class="header__cta-text text-center" data-aos="fade-up">
            <div class="col-md-6 col-sm-8 m-auto">
                <h1>
                    About us
                </h1>

            </div>
        </div>
@endsection
@section('content')

<main>
        <section class="c-about-us">
            <div class="container-fluid">
                <div class="row justify-content-between">
                    <div class="col-sm-8 col-md-6 mb-4">
                        <div class="c-about-us__content">
                            <article data-aos="fade-up">
                                <h3 class="mb-3  c-about-us__title">
                                    About us
                                </h3>
                               
                                   {!! $about->description !!}
                            </article>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="c-about-company-growth">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6 mb-4">
                        <div class="bg-white p-4">
                            <article>
                                <p>
                                  {!! nl2br($about->col1) !!}
                                </p>
                            </article>
                        </div>
                    </div>
                    <div class="col-sm-6 mb-4">
                        <div class="bg-white p-4">
                            <article>
                                <p>
                                  {!! nl2br($about->col2) !!}
                                </p>
                            </article>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>




@endsection