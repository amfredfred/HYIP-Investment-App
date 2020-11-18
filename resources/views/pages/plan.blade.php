@section('title')
<title>{{ucfirst($settings['site_name'])}} -  Investment Plan</title>
<meta  name="description" content="Plan">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} -  Investment Plan"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('headerText')
<div class="header__cta-text text-center" data-aos="fade-up">
    <div class="col-md-6 col-sm-8 m-auto">
        <h1>
            Our Investment Plan
        </h1>

    </div>
</div>
@endsection
@section('content')

<main>
    <section class="c-pricing">
        <div class="container-fluid">
            <div class="row">
                @foreach($plans as $plan)
                <div class="col-md-4">
                    <div class="card c-plan">

                        <div class="cad-body p-4">
                            <div class="c-plan__heading">
                                <div class="c-plan__title">
                                    <h2>
                                        {{$plan->name}}
                                    </h2>
                                </div>
                                <div class="c-plan__info">

                                    <h5 class="c-plan__duration">{{number_format($plan->percentage)}}% {{$plan->compound->name}}</h5>
                                </div>
                            </div>
                           
                            <div class="c-plan-body">
                                <div class="c-plan-body__details">
                                    <ul class="list-unstyled">
                                        <li>
                                        {{$plan->compound->compound_turn_over}}
                                        </li>
                                        <li>
                                            Minimum Deposit: ${{number_format($plan->min,2)}}
                                        </li>
                                        <li>
                                            Maximum Deposit: ${{number_format($plan->max,2)}}
                                        </li>

                                        <li>
                                            {{number_format($plan->ref)}}% Referral Bonus 
                                        </li>
                                        @if($plan->id == 2)
                                         <li> 3 Months Contract Period </li>
                                        @else 
                                        <li> 1 Year Contract Period </li>
                                        @endif
                                       
                                    </ul>
                                </div>
                            </div>
                            <div class="c-plan-footer">
                                <div class="invest-btn">
                                    <a href="{{url('register')}}" class="btn btn--invest">Invest Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
</main>

@endsection