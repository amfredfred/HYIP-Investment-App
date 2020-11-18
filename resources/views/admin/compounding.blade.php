@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Compounding</title>
<meta  name="description" content="Compounding">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Compounding"/>
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
                            <h5 class="mb-4">Compounding User Money

                            </h5>
                            <div class="investment-form text-muted">

                                <form class="" method="Post" action="{{route('compounding')}}" enctype="multipart/form-data">
                                    @csrf    

                                    <div class="form-group">
                                        <label class="">Select User</label>

                                        <select  name="user"   class="form-control" data-live-search="true">
                                            <option value="" selected disabled>Select User</option>
                                            @foreach($users as $user)
                                            <option value="{{$user->id}}"> {{$user->username}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label class="">Select Days </label>

                                        <select  name="compound" class="form-control">
                                            <option value="" selected disabled>Select Days</option>
                                            @foreach($compounds as $compound)
                                            <option value="{{$compound->id}}" > {{$compound->name}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    


                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="submit" class="btn btn-primary">Set</button>
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
@section('script')

@endsection

@endsection

