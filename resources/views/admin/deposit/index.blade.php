@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage Deposit</title>
<meta  name="description" content="Manage Deposit">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Manage Deposit"/>
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
                            <h5 class="mb-4">All Deposits

                            </h5>
                            <div class="investment-form text-muted">
                                   <form  class="form-group"  method=get name=opts action="{{route('manage-deposit')}}" enctype="multipart/form-data">
                                @csrf
                                <td>
                                    <select name=type class="inpts form-control" onchange="document.opts.submit();">
                                        <option value="" @if(empty($type))selected @endif>All Deposit</option>
                                        <option value="running" @if($type == 'running')selected @endif>Running Deposit/Investment</option>
                                        <option value="completed" @if($type == 'completed')selected @endif>Completed Deposit/Investment</option>
                                        <option value="confirmed" @if($type == 'confirmed')selected @endif>Confirmed Deposit</option>
                                        <option value="pending" @if($type == 'pending')selected @endif>Pending Deposit</option>

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

                                            <table id="example5" class="table overflow-auto text-muted">
                                                <thead>
                                                    <tr>
                                                        <th>#txt</th>
                                                        <th>User</th>
                                                        <th>Plan</th>
                                                        <th>Coin</th>
                                                        <th>Amount</th>
                                                        <th>Profit</th>
                                                        <th>Date</th>
                                                        <th>Date Deposited</th>
                                                        <th>Deposit Status</th>
                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($deposits as $deposit)
                                                    <tr>
                                                        <td>{{$deposit->transaction_id}}</td>
                                                        <td>{{$deposit->user->username}}</td>
                                                        <td>{{$deposit->plan->name}}</td>
                                                        <td> {{$deposit->coin->name}}</td>
                                                        <td>
                                                            @if($deposit->plan->name == 'PLAN 6')
                                                            {{number_format($deposit->amount,2)}} BTC
                                                            @else
                                                            ${{number_format($deposit->amount,2)}}


                                                            @endif


                                                        </td>
                                                        <td>${{number_format($deposit->earn,2)}}</td>
                                                        <td> @if(empty($deposit->due_pay))
                                                            Deposit Not Started
                                                            @else
                                                            Expire in {{$deposit->due_pay->diffForHumans()}}

                                                            @endif</td>
                                                        <td>{{ date('F d, Y', strtotime($deposit->created_at)) }} {{ date('g:i A', strtotime($deposit->created_at)) }}</td>
                                                        <td style='white-space: nowrap'>
                                                            @if($deposit->status_deposit == true)
                                                            <span class=" badge-success" style="padding:1px 9px 2px;-webkit-border-radius: 9px; -moz-border-radius: 9px;
                                                                  border-radius: 9px">Confirmed</span>
                                                            @else
                                                            <span class="badge-danger" style="padding:1px 9px 2px;-webkit-border-radius: 9px; -moz-border-radius: 9px;
                                                                  border-radius: 9px" >Awaiting Payment</span>
                                                            @endif
                                                        </td>
                                                        <td style='white-space: nowrap'>
                                                            @if($deposit->status == true)
                                                            <span class="badge-success" style="padding:1px 9px 2px;-webkit-border-radius: 9px; -moz-border-radius: 9px;
                                                                  border-radius: 9px">Completed</span>
                                                            @else
                                                            <span class="badge-danger" style="padding:1px 9px 2px;-webkit-border-radius: 9px; -moz-border-radius: 9px;
                                                                  border-radius: 9px">Running</span>
                                                            @endif
                                                        </td>
                                                        <td style='white-space: nowrap'>

                                                            <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                                   action="{{route('delete-deposit',['id'=>$deposit->id])}}" >
                                                                @csrf   
                                                                <button type="submit"class="">
                                                                    <i class="fa fa-trash text-danger"></i>
                                                                </button>
                                                            </form>
                                                            @if($deposit->status_deposit == false)
                                                            <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                                   action="{{route('confirm-deposit',['id'=>$deposit->id])}}" >
                                                                @csrf   
                                                                <button type="submit" class="btn btn-success btn-sm">
                                                                    <i class="fa fa-check "></i> Confirm Payment
                                                                </button>
                                                            </form>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>


                                                @empty
                                                <div class="text-center ">
                                                    <h5 class="grey-text">No {{$type}} Deposit/Investment Yet.</h5>
                                                    <img src="{{asset('images/empty.png')}}" style="width: 80px;height: 80px">
                                                </div>

                                                @endforelse
                                                <th>#txt</th>
                                                <th>User</th>
                                                <th>Plan</th>
                                                <th>Coin</th>
                                                <th>Amount</th>
                                                <th>Profit</th>
                                                <th>Date</th>
                                                <th>Date Deposited</th>
                                                <th>Deposit Status</th>
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

