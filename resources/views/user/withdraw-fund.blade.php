@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; WITHDRAWAL</title>
<meta  name="description" content="WITHDRAWAL">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - WITHDRAWAL"/>
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
                            <h5 class="mb-4">Confirm Withdrawal
                                <small class="white-color">Cash Out balance to your Pocket using our supported gateway.</small>

                            </h5>
                            <div class="investment-form text-muted">




                                <div class="alert rebrand-card-content">
                                    <span class="text-center">You need to know gateway fee:</span><br>
                                    <span class="text-center"><b>We </b> will be charge you ${{number_format($settings['withdraw_charge'],2)}} in every Withdraw.</span>
                                </div>

                                <form  class="form-group"  method="POST" action="{{route('withdraw-fund')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="withdraw" value="{{$withdraw->id}}">

                                     <table class="table overflow-auto text-muted">
                                        <tbody><tr>
                                                <th>Payment System:</th>
                                                <td>{{ucfirst($name_full)}}</td>
                                            </tr>
                                            <tr>
                                                <th>Account:</th>
                                                <td>{{$address}}</td>
                                            </tr>
                                            <tr>
                                                <th>Debit Amount:</th>
                                                <td>${{number_format($withdraw->total_amount,2)}}</td>
                                            </tr>

                                            <tr>
                                                <th>Withdrawal Fee:</th>
                                                <td>
                                                    ${{number_format($withdraw->withdraw_charge,2)}}
                                                </td>
                                            </tr>

                                            <tr>
                                                <th>Credit Amount:</th>
                                                <td>${{number_format($withdraw->amount - $withdraw->withdraw_charge,2)}}</td>
                                            </tr>
                                            <tr>
                                                <th>{{$name}} Amount:</th>
                                                <td>{{number_format(floatval($amount_convert) , 8, '.', '')}}</td>
                                            </tr>


                                            @if($withdraw->confirm == false)
                                            <tr>
                                                <td colspan="2"><input type="submit" value="Confirm" class="btn btn-success px-3"></td>
                                            </tr>
                                            @else
                                        <td class="btn btn-success px-3" colspan="2">Confirmed</td>
                                        @endif

                                        </tbody></table>
                                </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</main>


@endsection


