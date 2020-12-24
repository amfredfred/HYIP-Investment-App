@section('title')
<title>{{ucfirst($settings['site_name'])}}</title>
<meta  name="description" content="{{ucfirst($settings['site_name'])}}">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}}"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />
@endsection
@extends('layouts.app')
@section('content')
<!-- /. End of Navigation -->
<div class="animation-slide owl-carousel owl-theme" id="animation-slide">
    <!-- Slide 1-->
    @foreach($sliders as $slider)
    <div class="item @if($loop->iteration == 1) slide-one @endif @if($loop->iteration == 2) slide-two @endif @if($loop->iteration == 3) slide-three @endif">
        <div class="slide-table">
            <div class="slide-tablecell">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="slide-text text-center">
                                <h2>{!! $slider->title !!} </h2>
                                <p>{!! $slider->description !!}</p>
                                <div class="slide-buttons">
                                    <a href="{{url('register')}}" class="slide-btn">Join Us</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- /.End of slider -->
<div class="ticker">
    <div class="list-wrpaaer">
        <iframe class="list-wrpaaer " src="https://widget.coinlib.io/widget?type=horizontal_v2&theme=light&pref_coin_id=1505&invert_hover=" width="100%" height="76px"  frameborder="0" border="0"></iframe>
    </div>

</div>

<div class="about_content">
    <div class="container">
        <div class="row about-text justify-content">
            <div class="col-md-6">
                <div class="about-info">
                    <h2>About Us</h2>
                    <div class="definition">{{$homepage->about_us_title}}</div>

                    <p> {!! $about->getAbout() !!}</p>
                    <a href="{{url('pages/about-us')}}" class="btn btn-default mr-20">Read more</a>
                    <!--<a href="#" class="btn btn-default-o mb-10">Our Service</a>-->
                    <div class="play-button">
                        <a href="{{asset($settings['video_1'])}}" class="btn-play popup-youtube">
                            <div class="play-icon"><i class="fa fa-play"></i></div>
                            <div class="play-text">
                                <div class="btn-title-inner">
                                    <div class="btn-title"><span>Watch Video</span></div>
                                    <div class="btn-subtitle"><span>About US</span></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="text-right">
                    <img src="{{asset($homepage->about_us_photo)}}" class="img-responsive" alt="">
                </div>
                <div class="quote">
                    {!! $homepage->about_us_quote !!}

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.End of about content -->
<div class="calculate">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="section_title">
                    <h3>Profit <span>Calculator</span></h3>
                    <p>  {{$homepage->cal_title}}</p>
                </div>
            </div>
        </div>
        <div class="row justify-content">
            <div class="col-sm-4">
                <div class="bitcoin-sack">
                    <img src="{{asset($homepage->cal_photo)}}" class="img-responsive center-block" alt="">
                </div>
            </div>
            <div class="col-sm-8 col-xs-12">
                <div class="exchange-content ">
                    <form class="form-inline exchange-form">
                        <div class="input-group">
                            <label>Amount </label>
                            <input type="number" name="amount" id="amount" class="form-control">
                        </div>
                        <div class="exchange-btn">
                            <span class="lnr lnr-arrow-right"></span>
                        </div>
                        <div class="input-group">
                            <div class="input-group-btn">
                                <select class="selectpicker plan" data-width="120px">
                                    <option value="" disabled selected>Select Plan</option>
                                    @foreach($plans as $plan)
                                    <option value="{{$plan->id}}">{{$plan->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                    <div class=" mb-5">
                        <div class="row ">
                            <div class="col-md-6 col-xs-6">
                        <span><small>Profit</small></span>
                        <br>
                        <p id="net_profit"><small>$0.00</small></p>
                            </div>
                              <div class="col-md-6 col-xs-6">
                        <span><small>Total Return</small></span>
                        <br>
                        <p id="return"><small>$0.00</small></p>
                              </div>
                        </div>
                    </div>
                     <br>
                    <div class="exchange-info mt-5">
                        <h4>How it works?</h4>
                        <p>
                            {{$homepage->cal_description}}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.End of calculate -->
<div class="features__content">
    <div id="content__bg"></div>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="section_title">
                    <h3>Service we <span>Provide</span></h3>
                    <p> {{$homepage->service_text}}</p>
                </div>
            </div>
        </div>
        @foreach($services as $service)
        <div class="col-sm-4 col-md-3">
            <div class="feature__box">
                <i class="{!! $service->icon !!}"></i>
                <div class="feature__content">
                    <h3>{!! $service->title!!}</h3>
                    <p>{!! $service->description !!}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- End of features content -->
<div class="crypto-strat">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="section_title">
                    <h3>How to Get  <span>Start</span></h3>
                    <p> {{$homepage->get_start_text}}</p>
                </div>
            </div>
        </div>
        <!--<div class="crypto-strat-title"><span>How to Get Start</span></div>-->
        <div class="start-steps">
            @foreach($get_started as $get_start)
            <div class="start-step">
                <!--<span class="start-step-number">3</span>-->
                <i class="step-icon {!! $get_start->icon !!}"></i>
                <div class="start-step-info">
                    <div class="step-name">
                        <span> {!! $get_start->title!!}</span>
                    </div>
                    <div class="step-text">
                        <span> {!! $get_start->description !!}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <a href="{{url('register')}}" class="btn btn-default">Get Start</a>
    </div>
</div>
<!-- /.End of How to Get  Start -->


@section('script')


<script>

    $('.plan').change(function () {
        var amount = jQuery('#amount').val();
        if (!amount) {
            toastr.error('You must enter amount first', {timeOut: 50000});
            $(".plan").val("");
            return false;
        }
        var planID = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },

        });
        if (planID) {
            $.ajax({
                type: "GET",
                url: "{{url('guest_get-coin')}}?amount=" + amount + "&plan_id=" + planID,
                success: function (res) {
                    if (res) {
                        if (res['status'] === 401) {
                            toastr.error(res['message_danger'], {timeOut: 50000});
                            $(".plan").val("");
                            return false;
                        }

                        $('#return').val('');
                        $('#net_profit').val('');
                        $("#net_profit").html(res.net_profit);
                        $("#return").html(res.return);
                        $(".plan").val("");

                    } else {
                        $('#net_profit').val('');
                        $('#return').val('');
                        $(".plan").val("");
                    }
                }
            });
        } else {
            $('#net_profit').val('');
            $('#return').val('');
        }


    });


</script>


@endsection

@endsection