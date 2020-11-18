@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Deposit</title>
<meta  name="description" content="Deposit">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Deposit"/>
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
                            <h5 class="mb-4">Make Investment</h5>
                            <div class="investment-form text-muted">
                                <form  class="form-group"  method="POST" action="{{route('deposit')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="user_id"   value="{{Auth::user()->id}}">
                                    <div class="form-group mb-4">
                                        <select name="plan"  class="custom-select plan">
                                            <option selected disabled>Select Plan</option>

                                            @foreach($plans as $plan)
                                            <option value="{{$plan->id}}">{{$plan->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="number" name="amount" id="plan_value" placeholder="400"
                                               class="form-control">
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-7">
                                            Estimated Earning: <span class="plan_profit"></span>
                                        </div>
                                        <input
                                            type="hidden"
                                            class="coin" name='coin_id' value="{{$coins->id}}"
                                            checked=""
                                            />
                                        <input type="hidden" id="p_id" class="coin" name='plan_id' value="">
                                        <div class="col-5 text-right">
                                            <button id='spend'  type="submit" class="btn btn-success px-3">Invest Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="investment-history mt-5">
                        <h5 class="mb-3">Investment history</h5>
                        <div class="history">
                            <table class="table overflow-auto text-muted">
                                @if(count($investments) < 1)
                                <h3 class="text-center">You Don't Have any Investment Yet</h3>

                                @else

                                <tr>
                                    <th>Date</th>
                                    <th>Plan</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Days Left</th>
                                </tr>

                                @foreach($investments as $invest)
                                <tr>
                                    <td>{{ date('F d, Y', strtotime($invest->created_at)) }} {{ date('g:i A', strtotime($invest->created_at)) }}</td>
                                    <td>{{$invest->plan->name}}</td>
                                    <td>${{number_format($invest->amount,2)}}</td>
                                    <td>
                                        @if(empty($invest->due_pay))
                                        <span class="text-danger"> Not Running </span>
                                        @else
                                        <span class="text-success"> Running </span>
                                        @endif


                                    </td>
                                    <td class="text-success">
                                        @if(empty($invest->due_pay))
                                        0 Days from now
                                        @else
                                        Expire in {{$invest->due_pay->diffForHumans()}}
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
        </div>
    </div>
</main>




@section('script')

<script>

    $('.plan').click(function () {
        var planID = $(this).val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        if (planID) {
            $.ajax({
                type: "GET",
                url: "{{url('get-plan')}}?plan_id=" + planID,
                success: function (res) {
                    if (res) {
                        $('#p_id').val('');
                        $('#plan_value').val('');
                        $('#amount').val('');
                        $('#sign').val('');
                        $('#plan_compound').val('');
                        $('.plan_profit').val('');
                        $("#plan_value").val($("#plan_value").val() + res.min);
                        $("#amount").val($("#amount").val() + res.amount);
                        $("#plan_compound").val($("#plan_compound").val() + res.percentage);
                        $(".plan_profit").html(res.profit);
                        $("#p_id").val($("#p_id").val() + res.p_id);
                        $("#sign").html(res.sign);
                    } else {
                        $('#plan_value').val('');
                        $('#sign').val('');
                        $('#plan_compound').val('');
                        $('#plan_profit').val('');
                        $('#p_id').val('');
                        $('#amount').val('');
                    }
                }
            });
        } else {
            $('#plan_value').val('');
            $('#sign').val('');
            $('#plan_compound').val('');
            $('.plan_profit').val('');
            $('#p_id').val('');
            $('#amount').val('');
        }
    });
</script>
<script>

    $('#spend').click(function () {
        var coinID = $(this).val();
        var planID = $("input[id=p_id]").val();
        if (planID) {
        } else {
            toastr.error("Please Select a Plan!", {timeOut: 50000});
            return false;
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }

        });
        if (coinID) {
            $.ajax({
                type: "GET",
                url: "{{url('get-coin')}}?coin_id=" + coinID + "&plan_id=" + planID,
                success: function (res) {
                    if (res) {

                        $('#usermoney').val('');
                        $('#message_danger').val('');
                        $('#message_success').val('');
                        if (res.status === 401) {
                            $("#message_danger").html(res.message_danger).show();
                            $("#message_success").html(res.message_danger).hide();
                            $("#spend").show();
                        } else {

                            $("#message_success").html(res.message_success).show();
                            $("#message_danger").html(res.message_danger).hide();
                            $("#spend").show();
                        }

                        $("#usermoney").html(res.usermoney);
                    } else {
                        $('#usermoney').val('');
                        $('#message_danger').val('');
                        $('#message_success').val('');
                    }
                }
            });
        } else {
            $('#usermoney').val('');
            $('#message_danger').val('');
            $('#message_success').val('');
        }
    });
</script>
@endsection
@endsection
