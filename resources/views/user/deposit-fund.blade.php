@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; DEPOSIT CONFIRMATION</title>
<meta  name="description" content="DEPOSIT CONFIRMATION">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - DEPOSIT CONFIRMATION"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.home')
@section('content')
<main>
    <div class="container">
        <div class="row">

            @include('layouts.link')
            <div class="col-md-10">
                <div class="page-content">
                    <div class="form mb-5">
                        <div class="col-md-6 m-auto">
                            <h5 class="mb-4">Confirm Investment</h5>
                            <div class="investment-history mt-5">

                                <div class="history">
                                    <span>You have selected to make <b>Bitcoin </b>deposit. Please note that you will
                                        be charged <b>${{number_format($invest->deposit_investment_charge,2)}}</b> </b> fee in every deposit. please check the following</span>
                                </div>
                                <div class="row">
                                    <table class="table overflow-auto text-muted">
                                        <thead>
                                            <tr class="th">
                                                <th>Reference Code</th>
                                                <th>Deposit amount</th>
                                                <th>Gateway fee</th>
                                                <th>Total fee</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="dark-color">{{$invest->transaction_id}}</td>
                                                <td class="dark-color">${{number_format($invest->amount,2)}}</td>
                                                <td class="dark-color">${{number_format($invest->deposit_investment_charge,2)}}</td>
                                                <td class="dark-color">${{number_format($invest->amount+$invest->deposit_investment_charge,2)}}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><br>
                                <div class="row">
                                    <div class="text-center"><b>Scan to pay</b></div>

                                    @if($fund == 'fund')
                                    <div class="text-center">
                                        <img id=coin_payment_image src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl={{$sendaddress}}?amount={{number_format(floatval($amount_convert) , 8, '.', '')}}"/>
                                    </div>
                                    <br/>
                                    @endif
                                    @if($fund == 'fund')
                                    <div class="btc_form btc1" id=btc_form>Please send exactly <b>{{number_format(floatval($amount_convert) , 8, '.', '')}} {{$name}}</b> to <i>
                                            <a href="{{$sendaddress}}?amount={{number_format(floatval($amount_convert) , 8, '.', '')}}&message=Deposit+to+Bitfury">{{$coin->address}}</a></i><br></div>
                                    <div id=placeforstatus>
                                        <strong>Order status:</strong> <span class="text-danger">Waiting for payment</span>
                                    </div>
                                    @else
                                    <div id=placeforstatus>
                                        <strong >Order status:</strong> <span class="text-success">Completed</span>
                                    </div> 
                                    @endif
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

</main>



@endsection

