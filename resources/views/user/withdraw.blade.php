@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Withdrawal</title>
<meta  name="description" content="Withdrawal">
<meta itemprop="keywords" name="keywords" content="Withdrawal"/>
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
                            <h5 class="mb-4">Request Withdrawal
                                <small class="white-color">Cash Out balance to your Pocket using our supported gateway.</small>

                            </h5>
                            <div class="investment-form text-muted">
                                <form  class="form-group"  method="POST" action="{{route('withdraw')}}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-4">
                                        <label for="method text-black-50">Select Method</label>
                                        <select name="coin" id="method" class="custom-select">
                                            @foreach($usercoin as $ucoin)

                                            <option value="{{$ucoin->coin_id}}">{{$ucoin->coin->name}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-4">
                                        <select name="withdraw_from"  class="custom-select">
                                            data-size="7"  required>
                                            <option value="" selected disabled>Withdraw from</option>
                                            <option value="all" {{old('withdraw_from') == 'all' ? 'selected' : '' }}>All </option>
                                            <option value="Balance" {{old('withdraw_from') == 'Balance' ? 'selected' : '' }}>Balance</option>
                                            <option value="Profit" {{old('withdraw_from') == 'Profit' ? 'selected' : '' }}>Profit</option>

                                            <option value="Referal Bonus" {{old('withdraw_from') == 'Referal Bonus' ? 'selected' : '' }}>Referal Bonus</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount text-light">Amount</label>
                                        <input type="number" value="{{old('amount') }}" name="amount" id="amount" placeholder="400"
                                               class="form-control">
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-6">
                                            Current Balance: ${{number_format($total_balance + $total_bonus + $total_earn,2)}}
                                        </div>
                                        <div class="col-6 text-right">
                                            <button class="btn btn-success px-3">Request Withdrawal</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="withdrawl-history mt-5">
                        <h5 class="mb-3">Withdrawal history</h5>
                        <div class="history">
                            <table class="table overflow-auto text-muted">
                                @if(count($withdraws) < 1)
                                <h3 class="text-center">You Don't Have any Withdrawal Yet</h3>

                                @else
                                <tr>
                                    <th>Date</th>
                                    <th>Method</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                                @foreach($withdraws as $withdraw)
                                <tr>
                                    <td>{{ date('F d, Y', strtotime($withdraw->created_at)) }} {{ date('g:i A', strtotime($withdraw->created_at)) }}</td>
                                    <td>{{$withdraw->coin->name}}</td>
                                    <td>${{number_format($withdraw->amount,2)}}</td>
                                    <td>
                                        @if($withdraw->status == false)
                                        <span  class="text-danger"> Pending</span>
                                        @else
                                        <span  class="text-success"> Completed </span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                                @endif

                            </table>
                        </div>
                    </div>
                </div>
            </div>

            </main>

            @endsection

