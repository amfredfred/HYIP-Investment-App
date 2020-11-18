@section('title')
<title>{{ucfirst($settings['site_name'])}} - FAQs</title>
<meta  name="description" content="FAQ">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - FAQs"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('headerText')
<div class="header__cta-text text-center" data-aos="fade-up">
    <div class="col-md-6 col-sm-8 m-auto">
        <h1>
            Frequently Asked Questions
        </h1>

    </div>
</div>
@endsection
@section('content')
<main class="c-faq">
    <div class="container">

        <ul class="list-unstyled">
            @foreach($faqs as $key=> $faq)
            <li>
                <div class="question p-2 rounded bg-light my-3" data-toggle="collapse" href="#faq-{{$key}}" role="button"
                     aria-expanded="false" aria-controls="collapseExample">
                    <a href="#" class="text-dark nav-link"> {!! $faq->title !!}</a>
                    <div class="answer collapse bg-white shadow-sm p-3 rounded collapse" id="faq-{{$key}}">
                        <p class="text-black-50">
                            {!! $faq->description !!}
                        </p>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</main>




@endsection