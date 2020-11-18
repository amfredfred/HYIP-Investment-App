@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Edit Account</title>
<meta  name="description" content="Edit Account">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Edit Account"/>
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
                            <h5 class="mb-4">Edit Your profile
                                <small class="white-color">My profile.</small>

                            </h5>
                            <div class="investment-form text-muted">

                    <form  class="form-group"  method="POST" action="{{route('edit_account')}}" enctype="multipart/form-data">
                                @csrf
                        
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group label-floating">

                                    <label  class="control-label" for="name">Full Name</label>
                                    <input id="name" name=full_name value='{{Auth::user()->full_name}}' type="text" value="Carl" class="form-control ext">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label  class="control-label" for="email">Email Address</label>
                                    <input id="email" name=email value='{{Auth::user()->email}}' type="email" class="form-control ext">
                                </div>
                            </div>

                        </div>
                       

                      
                       
                     
                        <br>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <span class="text-danger"> Leave Blank if you don't want change password</span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label  class="control-label" for="password">New Password</label>
                                    <input id="password" name="password" type="password" class="form-control ext">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group label-floating">
                                    <label  class="control-label" for="password-confirm">Confirm New Password</label>
                                    <input id="password-confirm" name="pconfirm_password " type="password" class="form-control ext">
                                </div>
                            </div>

                            <div class="col-md-12 text-center">
                                <span class="text-danger"> Leave Blank if you don't want change password</span>
                            </div>

                        </div>
                        <br>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="form-group label-floating">
                                        <label  class="control-label" for="about">Bitcoin Address</label>
                                        <input id="about" name="bitcoin_address" value="{{$bitcoin}}" type="text" value="" class="form-control ext">
                                    </div>
                                </div>
                            </div>
                        </div>
                       
                      
                        <br>
                        <a href="{{url('home')}}" class="btn btn-primary">Cancel Edit</a>
                        <button type="submit" class="btn btn-success pull-right">Update Profile</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>



    </div>


                        </main>

@endsection


