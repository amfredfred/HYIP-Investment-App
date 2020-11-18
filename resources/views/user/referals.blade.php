@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Referrals</title>
<meta  name="description" content="Referrals">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Referrals"/>
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
                    <div class="referral-link mb-4 p-3 bg-info text-light">
                        Referral Link: <span
                            class="d-inline-block bg-white text-dark px-3 py-1 rounded">{{url('register')}}?ref={{Auth::user()->username}}</span>
                    </div>

                    <div class="row">
                        <div class="col-6 col-md-6">
                            <div class="shadow-sm p-3 text-center">
                                <div class="main-content">
                                    <h3>
                                        {{number_format(count($refs))}}
                                    </h3>
                                </div>
                                <div class="supporting-content">
                                    <span class="text-black-50">
                                        Total Referrals
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-6">
                            <div class="shadow-sm p-3 text-center">
                                <div class="main-content">
                                    <h3>
                                        ${{number_format($commission,2)}}
                                    </h3>
                                </div>
                                <div class="supporting-content">
                                    <span class="text-black-50">
                                        Referral Earning
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="investment-history mt-5">
                        <h5 class="mb-3">Referral history</h5>
                        <div class="history">
                            <table class="table overflow-auto text-muted">
                                <tr>
                                    <th>S/N</th>
                                    <th>Date</th>
                                    <th>Referral</th>
                                </tr>
                                @forelse($refs as $ref)
                                @foreach($ref->refs as $r)
                                <tr>
                                    <td>{{$loop->iteration}}  </td>
                                    <td>{{ date('F d, Y', strtotime($r->created_at)) }} {{ date('g:i A', strtotime($r->created_at)) }}</td>
                                    <td>{{$r->username}}</td>

                                </tr>
                                @endforeach
                                @empty
                                <h4> There is no Refer You have made.</h4>
                                @endforelse

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


@endsection
