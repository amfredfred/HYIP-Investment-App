@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage Coins</title>
<meta  name="description" content="Manage Coins">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} -Manage Coins"/>
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
                            <h5 class="mb-4">All Coins

                            </h5>
                            <div class="investment-form text-muted">
  <br/>
                            <div class="">

                                <!-- right column -->
                                <div class="">
                                    <!-- general form elements disabled -->
                                    <div class="card card-warning">

                                        <!-- /.card-header -->
                                        <div class="card-body" style="overflow: auto!important">

                                            <table id="example5" class="table ">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Address</th>
                                                        <th>Api Key</th>
                                                        <th>Photo</th>
                                                        <th>Qcode Scan</th>
                                                        <th>Date Created</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($coins as $coin)
                                                    <tr>
                                                        <td>{{$coin->name}}</td>
                                                        <td>{{$coin->address}}</td>
                                                        <td>{{$coin->api_key}}</td>
                                                        <td> <img src="{{asset($coin->photo)}}" align=absmiddle hspace=1 height=17></td>
                                                        <td> <img src="{{asset($coin->q_code)}}" align=absmiddle hspace=1 height=17></td>

                                                        <td>{{ date('F d, Y', strtotime($coin->created_at)) }}</td>
                                                        <td style='white-space: nowrap'>
                                                            <button type="button" class="" data-toggle="modal" data-target="#edit{{$coin->id}}">
                                                                <i class="fa fa-edit text-success"></i>
                                                            </button>



                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <div class="modal fade" id="edit{{$coin->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit Coin - {{$coin->name}}</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form class="" method="Post" action="{{route('edit-coin',['id'=>$coin->id])}}" enctype="multipart/form-data">
                                                                    @csrf  
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" name="name" value="{{$coin->name}}" class="form-control" placeholder="Name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Address</label>
                                                                        <input type="text" name="address" value="{{$coin->address}}" class="form-control" placeholder="Address">
                                                                    </div>
                                                                     <div class="form-group">
                                                                        <label>Api Key</label>
                                                                        <input type="text" name="api_key" value="{{$coin->api_key}}" class="form-control" placeholder="Enter Api Key">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Photo</label>
                                                                        <img src="{{asset($coin->photo)}}" align=absmiddle hspace=1 height=17>
                                                                        <input type="file" name="photo"  class="form-control">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Qcode Scan</label>
                                                                        <img src="{{asset($coin->q_code)}}" align=absmiddle hspace=1 height=17>
                                                                        <input type="file" name="q_code"  class="form-control">
                                                                    </div>


                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-theme btn-success">Save</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>

                                                @empty
                                                <div class="text-center ">
                                                    <h5 class="grey-text">No Coin created yet.</h5>
                                                    <img src="{{asset('images/empty.png')}}" style="width: 80px;height: 80px">
                                                </div>

                                                @endforelse
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Api Key</th>
                                                <th>Photo</th>
                                                <th>Qcode Scan</th>
                                                <th>Date Created</th>
                                                <th>Actions</th>
                                                </tr>
                                                </tfoot>
                                            </table>

                                            {{$coins->appends($_GET)->links()}}
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


