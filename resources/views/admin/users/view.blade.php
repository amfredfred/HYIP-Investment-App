@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; View User</title>
<meta  name="description" content="View User">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - View User"/>
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
                            <h5 class="mb-4">View User

                            </h5>
                            <div class="investment-form text-muted">
                                        <div class="container profile">
                                            <div class="row">
                                                <div class="col text-center">
                                                    <img alt="picture" src="{{asset('images/user.png') }}" class="img-lg rounded-circle border shadow" />
                                                    <h2 class="mt-3"> {{$user->username}}</h2>
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col">
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">User Details</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#coin" role="tab" aria-controls="contact" aria-selected="false">Funds</a>
                                                        </li>

                                                    </ul>
                                                    <div class="tab-content card" id="myTabContent" style="overflow: auto!important">
                                                        <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab" style="overflow: auto!important">
                                                            <table class="table " style="overflow: auto!important">
                                                                <tr>
                                                                    <th>Full Name</th>
                                                                    <td style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 20rem;">{{$user->full_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Username</th>
                                                                    <td>{{$user->username}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th>Email</th>
                                                                    <td>{{$user->email}}</td>
                                                                </tr>

                                                            </table>
                                                        </div>

                                                        <div class="tab-pane fade" id="coin" role="tabpanel" aria-labelledby="address-tab">
                                                            <table id="example5" class="table " style="overflow: auto!important">
                                                                <thead>
                                                                    <tr>
                                                                        <th>Coin</th>
                                                                        <th>Address</th>
                                                                        <th>Amount</th>
                                                                        <th>Profit</th>
                                                                        <th>Bonus</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    @foreach($usercoin as $ucoin)
                                                                    <tr>
                                                                        <td>{{$ucoin->coin->name}}</td>
                                                                        <td>{{$ucoin->address}}</td>
                                                                        <td>${{number_format($ucoin->amount)}}</td>
                                                                        <td>${{number_format($ucoin->earn)}}</td>
                                                                        <td>${{number_format($ucoin->bonus)}}</td>
                                                                       
                                                                    </tr>
                                                                </tbody>

                                                                @endforeach
                                                                <th>Coin</th>
                                                                <th>Address</th>
                                                                <th>Amount</th>
                                                                <th>Profit</th>
                                                                <th>Bonus</th>
                                                                </tr>
                                                                </tfoot>
                                                            </table>


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


</main>



@endsection

