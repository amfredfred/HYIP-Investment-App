@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; {{Auth::user()->usernme}} Mailling</title>
<meta  name="description" content="{{Auth::user()->usernme}} Mailling">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - {{Auth::user()->usernme}} Mailling"/>
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
                            <h5 class="mb-4">Mailling System

                            </h5>
                            <div class="investment-form text-muted">


                                        <form class="" method="Post" action="{{route('mailing')}}" enctype="multipart/form-data">
                                            @csrf    
                                            <div class="form-group">
                                                <label>To Emails</label>
                                                <textarea  class="form-control" rows="4" name="emails" placeholder="separate with comma eg admin@gmail.com,example@gmail.com"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Title</label>
                                                <input type="text" name="title"  class="form-control" placeholder="Enter Title">
                                            </div>
                                           
                                            <div class="form-group">
                                                <label>Message</label>
                                                <textarea  class="form-control" rows="10" name="message"></textarea>
                                            </div>
                                    </div>
                                    <div class="modal-footer justify-content-between">
                                        <button type="submit" class="btn btn-theme btn-success">Send</button>
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
