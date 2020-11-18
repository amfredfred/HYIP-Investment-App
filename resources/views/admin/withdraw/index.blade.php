@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage Withdraw</title>
<meta  name="description" content="Manage Withdraw">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Manage Withdraw"/>
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
                        <div class="col-md-10 m-auto">
                            <h5 class="mb-4">All Withdrawals

                            </h5>
                            <div class="investment-form text-muted">
                                   <form  class="form-group"  method=get name=opts action="{{route('manage-withdraw')}}" enctype="multipart/form-data">
                                @csrf
                                <td>
                                    <select name=type class="inpts form-control" onchange="document.opts.submit();">
                                        <option value="" @if(empty($type))selected @endif>All Withdraw</option>
                                        <option value="completed" @if($type == 'completed')selected @endif>Completed Withdraw</option>
                                        <option value="pending" @if($type == 'pending')selected @endif>Pending Withdraw</option>

                                    </select>
                            </form>



                            <div class="clearfix"></div>
                            <br/>
                            <div class="">

                                <!-- right column -->
                                <div class="">
                                    <!-- general form elements disabled -->
                                    <div class="">

                                        <!-- /.card-header -->
                                        <div class="" style="overflow: auto!important">

                                           <table id="example5" class="table ">
                                                <thead>
                                                    <tr>
                                                        <th>#txt</th>
                                                        <th>User</th>
                                                        <th>Coin</th>
                                                        <th>Amount</th>
                                                        <th>Charge</th>
                                                        <th>Amount to Pay</th>
                                                        <th>Address</th>
                                                        <th>Withdraw From</th>
                                                        <th>Withdraw Date</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($withdraws as $withdraw)
                                                    <tr>
                                                        <td>{{$withdraw->transaction_id}}</td>
                                                        <td>{{$withdraw->user->username}}</td>
                                                        <td>  {{$withdraw->coin->name}}</td>
                                                        <td>${{number_format($withdraw->amount,2)}}</td>
                                                        <td>${{number_format($withdraw->withdraw_charge,2)}}</td>
                                                        <td>${{number_format($withdraw->amount - $withdraw->withdraw_charge,2)}}</td>
                                                        <td>
                                                            @foreach($withdraw->user->coin as $ucoin)
                                                            @if($withdraw->coin_id == $ucoin->coin_id)
                                                               {{$ucoin->address}}
                                                               @endif
                                                            @endforeach
                                                         
                                                        </td>
                                                        <td>{{$withdraw->withdraw_from}}</td>
                                                        <td>{{ date('F d, Y', strtotime($withdraw->created_at)) }}</td>
                                                        <td style='white-space: nowrap'>
                                                            @if($withdraw->status == true)
                                                            <span class=" badge-success" style="padding:1px 9px 2px;-webkit-border-radius: 9px; -moz-border-radius: 9px;
                                                                  border-radius: 9px">Confirmed</span>
                                                                  @else
                                                                
                                                           @endif
                                                                 @if($withdraw->status_withdraw == false)
                                                            <span class="badge-danger" style="padding:1px 9px 2px;-webkit-border-radius: 9px; -moz-border-radius: 9px;
                                                                  border-radius: 9px" >Awaiting Payment</span>

                                                            <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                                   action="{{route('reject-withdraw',['id'=>$withdraw->id])}}" >
                                                                @csrf   
                                                                <button type="submit"class="">
                                                                    <i class="fa fa-ban text-danger"></i> Reject
                                                                </button>
                                                            </form>
                                                            @endif
                                                        </td>

                                                        <td style='white-space: nowrap'>

                                                            <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                                   action="{{route('delete-withdraw',['id'=>$withdraw->id])}}" >
                                                                @csrf   
                                                                <button type="submit"class="">
                                                                    <i class="fa fa-trash text-danger"></i>
                                                                </button>
                                                            </form>
                                                            @if($withdraw->status_withdraw == false)
                                                            <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                                   action="{{route('confirm-withdraw',['id'=>$withdraw->id])}}" >
                                                                @csrf   
                                                                <button type="submit"class="btn btn-success btn-sm">
                                                                    <i class="fa fa-check text-success"></i> Confirm Withdraw
                                                                </button>
                                                            </form>
                                                            @endif
                                                            @if($withdraw->confirm == false)

                                                            <span class=" badge-danger" style="padding:1px 9px 2px;-webkit-border-radius: 9px; -moz-border-radius: 9px;
                                                                  border-radius: 9px">Invalid Withdraw</span>

                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>


                                                @empty
                                                <div class="text-center ">
                                                    <h5 class="grey-text">No {{$type}} Withdraws Yet.</h5>
                                                    <img src="{{asset('images/empty.png')}}" style="width: 80px;height: 80px">
                                                </div>

                                                @endforelse
                                                <th>#txt</th>
                                                <th>User</th>
                                                <th>Coin</th>
                                                <th>Amount</th>
                                                <th>Charge</th>
                                                <th>Amount to Pay</th>
                                                  <th>Address</th>
                                                <th>Withdraw From</th>
                                                <th>Withdraw Date</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                                </tr>
                                                </tfoot>
                                            </table>

                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                    <!-- /.card -->
                                </div>
                                <!--/.col (right) -->





                                </div><!-- col-4 -->
                            </div><!-- row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>





@endsection
