@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Settings</title>
<meta  name="description" content="Settings">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Settings"/>
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
                            <h5 class="mb-4">Settings

                            </h5>
                            <div class="investment-form text-muted">

                                        <form class="" method="Post" action="{{route('settings')}}" enctype="multipart/form-data">
                                            @csrf    
                                            <div class="form-group">
                                                <label>Site Name</label>
                                                <input type="text" name="site_name" value="{{$setting['site_name']}}" class="form-control" placeholder="Enter Site  Name">
                                            </div>
                                            <div class="form-group">
                                                <label>Site Phone Number</label>
                                                <input type="text" name="site_phone" value="{{$setting['site_phone']}}" class="form-control" placeholder="Enter Site Phone Number">
                                            </div>
                                            <div class="form-group">
                                                <label>Site Url</label>
                                                <input type="text" name="site_url" value="{{$setting['site_url']}}" class="form-control" placeholder="Enter Site Url">
                                            </div>
                                            <div class="form-group">
                                                <label>Site Email</label>
                                                <input type="text" name="site_email" value="{{$setting['site_email']}}" class="form-control" placeholder="Site Email">
                                            </div>
                                            <div class="form-group">
                                                <label>Site Send Notify Email</label>
                                                <input type="text" name="send_notify_email" value="{{$setting['send_notify_email']}}" class="form-control" placeholder="site Notify Email">
                                            </div>
                                            <div class="form-group">
                                                <label>Referral Percentage</label>
                                                <input type="text" name="ref_percentage" value="{{$setting['ref_percentage']}}" class="form-control" placeholder="Referral Percentage">
                                            </div>
                                            <div class="form-group">
                                                <label>Address</label>
                                                <textarea type="text" name="address" class="form-control" placeholder="Address">{{$setting['address']}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Site Short Code Name</label>
                                                <input type="text" name="site_code" value="{{$setting['site_code']}}" class="form-control" placeholder="site short code name">
                                            </div>
                                            <div class="form-group">
                                                <label>Site Location</label>
                                                <input type="text" name="location" value="{{$setting['location']}}" class="form-control" placeholder="Location">
                                            </div>
                                            <div class="form-group">
                                                <label>Video Link</label>
                                                <input type="text" name="video_link" value="{{$setting['video_link']}}" class="form-control" placeholder="Video Link">
                                            </div>
                                            <div class="form-group">
                                                <label>Site Copy Right Name</label>
                                                <input type="text" name="copy_right" value="{{$setting['copy_right']}}" class="form-control" placeholder="Copy Right">
                                            </div>
                                            <div class="form-group">
                                                <label>Deposite Charge</label>
                                                <input type="text" name="deposit_investment_charge" value="{{$setting['deposit_investment_charge']}}" class="form-control" placeholder="Deposit Charge">
                                            </div>
                                            <div class="form-group">
                                                <label>Minimum Withdraw</label>
                                                <input type="text" name="min_withdraw" value="{{$setting['min_withdraw']}}" class="form-control" placeholder="Minimum Withdraw">
                                            </div>
                                            <div class="form-group">
                                                <label>Withdraw Charge</label>
                                                <input type="text" name="withdraw_charge" value="{{$setting['withdraw_charge']}}" class="form-control" placeholder="Withdraw Charge">
                                            </div>
                                            <div class="form-group">
                                                <label>BlockIO Secrent Pin </label>
                                                <input type="text" name="block_io_pin" value="{{$setting['block_io_pin']}}" class="form-control" placeholder="Your Blockio Password">
                                            </div>

                                            <div class="form-group">
                                                <img id="footer-logo-img" class="img-center" src="{{asset($settings['logo']) }}" alt="">
                                                <label>Site Logo</label>
                                                <input type="file" name="logo"  class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <img id="footer-logo-img" class="img-center" src="{{asset($settings['favicon']) }}" alt="">
                                                <label>Favicon</label>
                                                <input type="file" name="favicon"  class="form-control" >
                                            </div>
                                            <div class="form-group">
                                                <label class="">Investment Payment Mode</label>

                                                <select  name="mode" class="form-control">
                                                    <option value="" selected disabled>Select Mode</option>

                                                    <option value="0" {{$setting['investment_payment_mode'] == false ? 'selected' : '' }}> Daily </option>
                                                    <option value="1" {{$setting['investment_payment_mode'] == true ? 'selected' : '' }}> Compound Date</option>

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="">Auto Withdraw</label>

                                                <select  name="auto_withdraw" class="form-control">
                                                    <option value="" selected disabled>Select Mode</option>

                                                    <option value="0" {{$setting['auto_withdraw'] == false ? 'selected' : '' }}> Off </option>
                                                    <option value="1" {{$setting['auto_withdraw'] == true ? 'selected' : '' }}> On</option>

                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Email Template</label>
                                                <textarea id="area1" class="form-control" rows="30" name="email_body">{{$setting['email_body']}}</textarea>
                                            </div>
											<div class="form-group">
                                                <label>Running Days</label>
                                                <input type="text" name="running_days" value="{{$setting['running_days']}}" class="form-control" placeholder="running days">
                                            </div>
											<div class="form-group">
                                                <label>Add Deposit Money</label>
                                                <input type="text" name="deposit" value="{{$setting['deposit']}}" class="form-control" placeholder="Add Deposit Money Increase">
                                            </div>
											<div class="form-group">
                                                <label>Add Withdraw Money</label>
                                                <input type="text" name="withdraw" value="{{$setting['withdraw']}}" class="form-control" placeholder="Add Withdraw Money Increase">
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                    </form>  






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

