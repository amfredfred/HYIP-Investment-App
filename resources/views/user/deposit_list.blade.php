@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Deposit List</title>
<meta  name="description" content="Deposit List">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Deposit List"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.homeuser')
@section('content')


<div class="res-ac">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="w3-clear nextprev">
                    <a class="w3-left w3-btn" href="{{url('home')}}"><i class="fa fa-user"></i> Dashboard</a>
                    <button onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" style="padding: 3px 13px;background: #F44336 none repeat scroll 0 0;border: 1px solid #e43d31; color: white !important; border-radius: 6px; font-size: 15px">Logout</button>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="insidebanner_wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                <h2>Deposit List</h2>
            </div>
            <!---<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><img alt="Bitcoin x2 in 50 days" src="styles/images/coin.png" /></div>--->
        </div>
    </div>
</div>
</div>
<div class="member_wrap">
    @include('layouts.linkheader')


    <div class="member_inside">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md12 col-sm-12 col-xs-12">
                    <div class="mem_wrapper">



                        <div class="row">
                            @include('layouts.link')

                            <div class="col-md-9">
                                <div class="member-container">
                                    <div class="member-right">



                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="card rebrand-card">
                                                    <div class="card-header card-header-icon" data-background-color="green">
                                                        <i class="material-icons">payment</i>
                                                    </div>
                                                    <br>
                                                    <h4 class="text-center">My Deposit History</h4>
                                                    <div class="card-content">
                                                        <br>
                                                        <div class="table-responsive">

                                                            <table class="table">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="text-center">SN</th>
                                                                        <th class="text-center">Plan</th>
                                                                        <th class="text-center">Investment Status</th>
                                                                        <th class="text-center">Transaction Id</th>
                                                                        <th class="text-center">Amount</th>
                                                                        <th class="text-center">Profit</th>
                                                                        <th class="text-center">Charge</th>
                                                                        <th class="text-center">Funded Amount</th>
                                                                        <th class="text-center">Time</th>
                                                                        <th class="text-center">Status</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($deposits as $hi)
                                                                    <tr>
                                                                        <td class="text-center">{{$loop->iteration}}</td>
                                                                        <td class="text-center">{{$hi->plan->name}}</td>
                                                                        <td class="text-center">

                                                                            @if(empty($hi->due_pay))
                                                                            <button class="btn btn-danger">
                                                                                <span class="btn-label">
                                                                                </span>

                                                                                Deposit Not Started Running
                                                                            </button>
                                                                            @else
                                                                            <button class="btn btn-info">
                                                                                <span class="btn-label">
                                                                                </span>

                                                                                Expire in {{$hi->due_pay->diffForHumans()}}
                                                                            </button>

                                                                            @endif

                                                                        </td>
                                                                        <td class="text-center">{{$hi->transaction_id}}</td>
                                                                        <td class="text-center">${{number_format($hi->amount,2)}}</td>
                                                                            <td class="text-center">${{number_format($hi->earn,2)}}</td>
                                                                        <td class="text-center">${{number_format($hi->deposit_investment_charge,2)}}</td>
                                                                        <td class="text-center">{{number_format($hi->total,2)}}</td>
                                                                        <td class="text-center">{{ date('F d, Y', strtotime($hi->created_at)) }} {{ date('g:i A', strtotime($hi->created_at)) }}</td>
                                                                        <td >

                                                                            @if($hi->status == false)
                                                                           

                                                                                @if(empty($hi->due_pay))
                                                                                <button class="btn btn-danger">
                                                                                    <span class="btn-label">
                                                                                    </span>

                                                                                    Pending
                                                                                </button>
                                                                                @else
                                                                                <button class="btn btn-info">
                                                                                    <span class="btn-label">
                                                                                    </span>
                                                                                    Running
                                                                                </button>

                                                                                @endif
                                                                            </button>
                                                                            @else
                                                                            <button class="btn btn-success">
                                                                                <span class="btn-label">
                                                                                </span>

                                                                                Completed
                                                                            </button>
                                                                            @endif







                                                                        </td>
                                                                    </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                            <center>
                                                                {{$deposits->appends($_GET)->links()}}
                                                            </center>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-sm-6 col-sm-offset-5">



                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                    </div><!-- col-4 -->
                                </div><!-- row -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <style>
            .single-team {
                display: block;
                height: auto;
                margin-bottom: 30px;
                overflow: hidden;
                border: 1px solid #4d4b71;
            }

            .team-details {
                /* background: #fff none repeat scroll 0 0; */
                padding: 14px 0;
                position: relative;
                text-align: center;
                z-index: 99999;
            }

            .team-details>h3 {
                color: #333;
                font-size: 21px;
                font-weight: 500;
                text-transform: capitalize;
            }

            .team-contact {
                padding: 0 25px;
                text-align: center;
                position: relative;
                z-index: 99999;
            }

            .team-contact>p {
                margin: 10px 0;
                text-align: center;
                color: #fff;
                font-size: 22px;
            }

            .team-contact i {
                color: #cccaf3;
                font-size: 68px;
                margin-right: 5px;
            }

            .team-contact>a {
                background: #ff9606 none repeat scroll 0 0;
                border: 1px solid #ff9606;
                border-radius: 5px;
                color: #fff;
                display: inline-block;
                font-weight: 500;
                padding: 5px 10px;
                text-transform: uppercase;
                margin-top: 10px
            }

            .team-image {
                height: 100%;
                left: 0;
                position: absolute;
                top: 0;
                -webkit-transition: all 0.5s ease 0s;
                transition: all 0.5s ease 0s;
                width: 100%;
            }

            .team-image>img {
                height: 100%;
                width: 100%;
                opacity: .1;
            }

            .team_img_overlay_1 {
                border-color: rgba(255, 150, 6, 0.58) transparent;
                border-style: solid;
                border-width: 0 265px 125px 0;
                content: "";
                height: 100%;
                left: 0;
                overflow: visible;
                position: absolute;
                top: 0;
                width: 100%;
                z-index: 9;
            }

            .single-team:hover div.team-image {
                left: -100%;
            }

            .member-right h3 {
                margin: 0 0 15px;
                color: #9996cb;
                font-size: 15px;
                font-weight: 700;
                text-transform: uppercase;
            }

            /* Font awasam css animation */
            .faa-parent.animated-hover:hover>.faa-spin,
            .faa-spin.animated,
            .faa-spin.animated-hover:hover {
                /* -webkit-animation: spin 1.5s linear infinite; */
                animation: spin 5.5s linear infinite;
            }
        </style>



    </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

@endsection

