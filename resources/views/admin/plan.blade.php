@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage Plan</title>
<meta  name="description" content="Manage Plan">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Manage Plan"/>
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
                            <h5 class="mb-4">All Plans

                            </h5>
                            <div class="investment-form text-muted">

                                <br/>
                                <button type="button" class="btn btn-theme btn-circle btn-success" data-toggle="modal" data-target="#modal-default">
                                    Add New Plan
                                </button>
                                <div class="modal fade" id="modal-default" >
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <div class="modal-header ">
                                                <h4 class="modal-title">Add Plan</h4>

                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <form class="" method="Post" action="{{url('add-plan')}}" enctype="multipart/form-data">
                                                    @csrf    

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group"> 
                                                                <input  type=text name=name value="" class="form-control" placeholder="Name" required="required" data-error="Name is required.">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type=text name=ref value="" class="form-control" placeholder="Referral Bonus" required="required">

                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group"> 
                                                                <input  type=text name=min class="form-control" placeholder="Min" required="required">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group"> 
                                                                <input id="password" type=text name=max value="" class="form-control" placeholder="Max" required="required">
                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type=text class="form-control" size=30 name="percentage"  placeholder="Percentage">

                                                                <div class="help-block with-errors"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <select  name="compound_id" class="form-control">
                                                                    <option value="" selected disabled>Select Compound</option>
                                                                    @foreach($compounds as $compound)
                                                                    <option value="{{$compound->id}}"> {{$compound->name}} </option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label>Photo</label>
                                                                <input type="file" name="photo"  class="form-control">
                                                            </div>
                                                        </div>




                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-theme btn-circle btn-success">Add</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                <div class="clearfix"></div>
                                <br/>
                                <div class="">

                                    <!-- right column -->
                                    <div class="">
                                        <!-- general form elements disabled -->
                                        <div class="card card-warning">

                                            <!-- /.card-header -->
                                            <div class="card-body" style="overflow: auto!important">

                                                <table id="example5" class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Min</th>
                                                            <th>Max</th>
                                                            <th>Percentage</th>
                                                            <th>Referral Bonus</th>
                                                            <th>Compound</th>
                                                            <th>Photo</th>
                                                            <th>Date Created</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($plans as $plan)
                                                        <tr>
                                                            <td>{{$plan->name}}</td>
                                                            <td>@if($plan->name == 'PLAN 6') {{$plan->min}} BTC   @else ${{$plan->min}} @endif</td>
                                                            <td> @if($plan->name == 'PLAN 6') {{$plan->max}} BTC   @else ${{$plan->max}} @endif</td>
                                                            <td>{{$plan->percentage}}%</td>
                                                            <td>{{$plan->ref}}%</td>
                                                            <td>{{$plan->compound->name}}</td>
                                                            <td> <img src="{{asset($plan->image)}}" align=absmiddle hspace=1 height=17></td>
                                                            <td>{{ date('F d, Y', strtotime($plan->created_at)) }}</td>
                                                            <td style='white-space: nowrap'>
                                                                <button type="button" class="" data-toggle="modal" data-target="#edit{{$plan->id}}">
                                                                    <i class="fa fa-edit text-success"></i>
                                                                </button>

                                                                <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                                       action="{{route('delete-plan',['id'=>$plan->id])}}" >
                                                                    @csrf   
                                                                    <button type="submit"class="">
                                                                        <i class="fa fa-trash text-danger"></i>
                                                                    </button>
                                                                </form> 

                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <div class="modal fade" id="edit{{$plan->id}}">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">

                                                                <div class="modal-header">
                                                                    <h4 class="modal-title">Edit Plan - {{$plan->name}}</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <div class="modal-body">
                                                                    <form class="" method="Post" action="{{route('edit-plan',['id'=>$plan->id])}}" enctype="multipart/form-data">
                                                                        @csrf  
                                                                        <div class="form-group">
                                                                            <label>Name</label>
                                                                            <input type="text" name="name" value="{{$plan->name}}" class="form-control" placeholder="Name">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Referral Bonus</label>
                                                                            <input type="text" name="ref" value="{{$plan->ref}}" class="form-control" placeholder="Referral Bonus">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Min</label>
                                                                            <input type="text" name="min" value="{{$plan->min}}" class="form-control" placeholder="Min">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Max</label>
                                                                            <input type="text" name="max" value="{{$plan->max}}" class="form-control" placeholder="Max">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Percentage</label>
                                                                            <input type="text" name="percentage" value="{{$plan->percentage}}" class="form-control" placeholder="Percentage">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label class="">Compound</label>

                                                                            <select  name="compound_id" class="form-control">
                                                                                <option value="" selected disabled>Select Compund</option>
                                                                                @foreach($compounds as $compound)
                                                                                <option value="{{$compound->id}}" {{$plan->compound_id == $compound->id ? 'selected' : '' }}> {{$compound->name}} </option>
                                                                                @endforeach


                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label>Photo</label>
                                                                            <img src="{{asset($plan->image)}}" align=absmiddle hspace=1 height=17>
                                                                            <input type="file" name="photo"  class="form-control">
                                                                        </div>
                                                                </div>
                                                                <div class="modal-footer justify-content-between">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-theme btn-circle btn-success">Save</button>
                                                                </div>
                                                                </form>
                                                            </div>
                                                            <!-- /.modal-content -->
                                                        </div>
                                                        <!-- /.modal-dialog -->
                                                    </div>

                                                    @empty
                                                    <div class="text-center ">
                                                        <h5 class="grey-text">No Plan created yet.</h5>
                                                        <img src="{{asset('images/empty.png')}}" style="width: 80px;height: 80px">
                                                    </div>

                                                    @endforelse
                                                    <th>Name</th>
                                                    <th>Min</th>
                                                    <th>Max</th>
                                                    <th>Percentage</th>
                                                    <th>Referral Bonus</th>
                                                    <th>Compound</th>
                                                    <th>Date Created</th>
                                                    <th>Actions</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>

                                                {{$plans->appends($_GET)->links()}}
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


