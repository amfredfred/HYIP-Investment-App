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

                <h1>History</h1>
                <p><span class="text-theme">Your history</span></p>
            </div>
            <div class="col-lg-6 col-md-12 text-lg-right md-mt-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-4 justify-content-end">
                        <li class="breadcrumb-item"><a href="{{url('home')}}"><i class="fas fa-home"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Pages</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">History</li>
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
                                <p>History</p>
                            </div>

                            <div class="desh_menu">
                                <div class="desh-menu">
                                    <ul>
                                        @include('layouts.link')
                                    </ul>
                                </div>
                            </div>

                            <script language=javascript>
                                function go(p)
                                {
                                    document.opts.page.value = p;
                                    document.opts.submit();
                                }
                            </script>


                            <table cellspacing=10 cellpadding=10 border=1 width=100% style="border: 1px solid #0000cc;">
                                <tr>
                                    <td colspan=3>
                                        <h3>History:</h3>
                                    </td>
                                </tr>
                                <tr>
                                <form  class="form-group"  method=post name=opts action="{{route('get_history')}}" enctype="multipart/form-data">
                                    @csrf
                                    <td>
                                        <select name=type class=inpts onchange="document.opts.submit();">
                                            <option value="" @if(empty($type))selected @endif>All transactions</option>
                                            <option value="deposit" @if($type == 'Deposit')selected @endif>Deposit</option>
                                            <option value="bonus" @if($type == 'bonus')selected @endif>Bonus</option>
                                            <option value="earning" @if($type == 'earning')selected @endif>Earning</option>
                                            <option value="withdrawal" @if($type == 'withdrawal')selected @endif >Withdrawal</option>
                                            <option value="early_deposit_release" @if($type == 'early_deposit_release')selected @endif >Deposit release</option>
                                            <option value="release_deposit" @if($type == 'release_deposit')selected @endif>Deposit returned to user account</option>
                                            <option value="commissions" @if($type == 'commissions')selected @endif >Referral commission</option>
                                        </select>
                                </form>
                                <br><img src=images/q.gif width=1 height=4><br>
                                <form  class="form-group"  method=post name=coin action="{{route('get_history')}}" enctype="multipart/form-data">
                                    @csrf
                                    <select name=type class=inpts onchange="document.coin.submit();">

                                        <option value="1" @if($type == 1)selected @endif>All eCurrencies</option>
                                        @foreach($coins as $coin)
                                        <option value="{{$coin->slug}}" @if($type == $coin->slug)selected @endif >{{$coin->name}}</option>
                                        @endforeach
                                    </select>
                                </form>
                                </td>
                                <form  class="form-group"  method=post name=coin action="{{route('get_history')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="type" value="filtere">
                                    <td align=right>
                                        From: <select name=month_from class=inpts>
                                            <option value=1 >Jan
                                            <option value=2 >Feb
                                            <option value=3 >Mar
                                            <option value=4 >Apr
                                            <option value=5 >May
                                            <option value=6 >Jun
                                            <option value=7 >Jul
                                            <option value=8 >Aug
                                            <option value=9 >Sep
                                            <option value=10 >Oct
                                            <option value=11 >Nov
                                            <option value=12 selected>Dec
                                        </select> &nbsp;
                                        <select name=day_from class=inpts>
                                            <option value=1 >1
                                            <option value=2 >2
                                            <option value=3 >3
                                            <option value=4 >4
                                            <option value=5 selected>5
                                            <option value=6 >6
                                            <option value=7 >7
                                            <option value=8 >8
                                            <option value=9 >9
                                            <option value=10 >10
                                            <option value=11 >11
                                            <option value=12 >12
                                            <option value=13 >13
                                            <option value=14 >14
                                            <option value=15 >15
                                            <option value=16 >16
                                            <option value=17 >17
                                            <option value=18 >18
                                            <option value=19 >19
                                            <option value=20 >20
                                            <option value=21 >21
                                            <option value=22 >22
                                            <option value=23 >23
                                            <option value=24 >24
                                            <option value=25 >25
                                            <option value=26 >26
                                            <option value=27 >27
                                            <option value=28 >28
                                            <option value=29 >29
                                            <option value=30 >30
                                            <option value=31 >31
                                        </select> &nbsp;

                                        <select name=year_from class=inpts>
                                            <option value=2010 >2010
                                            <option value=2011 >2011
                                            <option value=2012 >2012
                                            <option value=2013 >2013
                                            <option value=2014 >2014
                                            <option value=2015 >2015
                                            <option value=2016 >2016
                                            <option value=2017 >2017
                                            <option value=2018 >2018
                                            <option value=2019 selected>2019
                                            <option value=2020 >2020
                                        </select><br><img src=images/q.gif width=1 height=4><br>

                                        To: <select name=month_to class=inpts>
                                            <option value=1 selected>Jan
                                            <option value=2 >Feb
                                            <option value=3 >Mar
                                            <option value=4 >Apr
                                            <option value=5 >May
                                            <option value=6 >Jun
                                            <option value=7 >Jul
                                            <option value=8 >Aug
                                            <option value=9 >Sep
                                            <option value=10 >Oct
                                            <option value=11 >Nov
                                            <option value=12 >Dec
                                        </select> &nbsp;
                                        <select name=day_to class=inpts>
                                            <option value=1 >1
                                            <option value=2 >2
                                            <option value=3 >3
                                            <option value=4 >4
                                            <option value=5 >5
                                            <option value=6 >6
                                            <option value=7 >7
                                            <option value=8 >8
                                            <option value=9 >9
                                            <option value=10 >10
                                            <option value=11 >11
                                            <option value=12 >12
                                            <option value=13 >13
                                            <option value=14 >14
                                            <option value=15 >15
                                            <option value=16 >16
                                            <option value=17 >17
                                            <option value=18 >18
                                            <option value=19 >19
                                            <option value=20 >20
                                            <option value=21 >21
                                            <option value=22 >22
                                            <option value=23 >23
                                            <option value=24 >24
                                            <option value=25 >25
                                            <option value=26 >26
                                            <option value=27 >27
                                            <option value=28 selected>28
                                            <option value=29 >29
                                            <option value=30 >30
                                            <option value=31 >31
                                        </select> &nbsp;

                                        <select name=year_to class=inpts>
                                            <option value=2010 >2010
                                            <option value=2011 >2011
                                            <option value=2012 >2012
                                            <option value=2013 >2013
                                            <option value=2014 >2014
                                            <option value=2015 >2015
                                            <option value=2016 >2016
                                            <option value=2017 >2017
                                            <option value=2018 >2018
                                            <option value=2019 >2019
                                            <option value=2020 selected>2020
                                        </select>

                                    </td>
                                    <td>
                                        &nbsp; <input type=submit value="Go" class="btn btn-theme btn-circle">
                                    </td>
                                </tr></table>
                            </form>
                            <br><br>

                            <table cellspacing=10 cellpadding=12 border=1 width=100% style="border: 1px solid #0000cc;">
                                <tr>
                                    <td class=inheader><b>Type</b></td>
                                    <td class=inheader width=200><b>Amount</b></td>
                                    <td class=inheader width=170><b>Date</b></td>
                                </tr>
                                @foreach($histories as $hi)
                                <tr>
                                    <td><b>{{$hi->name_type}}</b></td>
                                    <td width=200 align=right><b>${{number_format($hi->amount)}}</b>
                                        <img src="{{asset($hi->coin->photo)}}" align=absmiddle hspace=1 height=17></td>
                                    <td width=170 align=center valign=bottom><b><small>{{ date('F d, Y', strtotime($hi->created_at)) }} {{ date('g:i A', strtotime($hi->created_at)) }}</small></b></td>
                                </tr>
                                @endforeach
                            </table>
                            <br/>
                            <center>
                                {{$histories->appends($_GET)->links()}}
                            </center>
                        </div>


                    </div>
                </div>
                </section>
                @endsection
