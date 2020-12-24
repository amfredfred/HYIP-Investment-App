@section('title')
<title>{{ucfirst($settings['site_name'])}} -  Investment Plan</title>
<meta  name="description" content="Plan">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} -  Investment Plan"/>
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

                        <div class="company">Investment Plan</div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-bg-intro"><img src="assets/img/mask.png" class="intro-round" alt=""></div>
</div>
<!--  /.End of page header -->
<div class="crypto-details">
    <div class="container">
        <div class="crypto-details-info">
            @foreach($plans as $plan)
            <div class="info-cell">
                <div class="info-cell-title">
                    {{$plan->name}}
                </div>
                <div class="info-cell-value">
                    <span class="percent_positive">{{number_format($plan->percentage)}}% {{$plan->compound->name}}</span>
                </div>
                <ul class="list-unstyled">
                    <li>
                        {{$plan->compound->compound_turn_over}}
                    </li>
                    <hr>
                    <li>
                        Minimum Deposit : ${{number_format($plan->min,2)}}
                    </li>
                    <hr>
                    <li>
                        Maximum Deposit : ${{number_format($plan->max,2)}}
                    </li>
                    <hr>
                    <li>
                        {{number_format($plan->ref)}}% Referral Bonus 
                    </li>
                    <hr>
                    @if($plan->id == 2)
                    <li> 3 Months Contract Period </li>
                    @else 
                    <li> 1 Year Contract Period </li>
                    @endif

                </ul> <hr>
                
                  <div class="slide-buttons">
                                    <a href="{{url('register')}}" class="btn btn-default slide-btn">Subscribe Now</a>
                                </div>
            </div>
            @endforeach

        </div>


    </div>
</div>
<div class="pricing-new">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="price-chart">
                    <div style="height:560px; background-color: #FFFFFF; overflow:hidden; box-sizing: border-box; border: 1px solid #56667F; border-radius: 4px; text-align: right; line-height:14px; font-size: 12px; font-feature-settings: normal; text-size-adjust: 100%; box-shadow: inset 0 -20px 0 0 #56667F;padding:1px;padding: 0px; margin: 0px; width: 100%;"><div style="height:540px; padding:0px; margin:0px; width: 100%;"><iframe src="https://widget.coinlib.io/widget?type=chart&theme=light&coin_id=859&pref_coin_id=1505" width="100%" height="536px" scrolling="auto" marginwidth="0" marginheight="0" frameborder="0" border="0" style="border:0;margin:0;padding:0;line-height:14px;"></iframe></div><div style="color: #FFFFFF; line-height: 14px; font-weight: 400; font-size: 11px; box-sizing: border-box; padding: 2px 6px; width: 100%; font-family: Verdana, Tahoma, Arial, sans-serif;">
                        </div></div>	
                </div>
                <!-- /.End of chart -->

            </div>
        </div>
    </div>
</div>


@endsection