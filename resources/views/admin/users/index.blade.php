@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Manage Users</title>
<meta  name="description" content="Manage Users">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Manage Users"/>
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
                            <h5 class="mb-4">All Users

                            </h5>
                            <div class="investment-form text-muted">

<button type="button" class="btn btn-theme btn-circle btn-success" data-toggle="modal" data-target="#modal-default">
                                Add New Users
                            </button>
                            <div class="modal fade" id="modal-default" >
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">

                                        <div class="modal-header ">
                                            <h4 class="modal-title">Add User</h4>

                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <div class="modal-body">
                                            <form class="" method="Post" action="{{url('add-user')}}">
                                                @csrf    

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group"> <i class="far fa-user"></i>
                                                            <input id="full_name" type=text name=full_name value="" class="form-control" placeholder="Full name" required="required" data-error="Fullname is required.">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group"> <i class="far fa-user"></i>
                                                            <input id="username" type=text name=username class="form-control" placeholder="Username" required="required">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group"> <i class="fas fa-unlock-alt"></i>
                                                            <input id="password" type=password name=password value="" class="form-control" placeholder="Password" required="required">
                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group"> <i class="far fa-envelope"></i>
                                                            <input id="email" type=text name=email value="" class="form-control" placeholder="Email" required="required">

                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group"> <i class="fa fa-credit-card"></i>
                                                            <input type=text class="form-control" size=30 name="bitcoin_address"  data-validate-notice="Bitcoin Address" placeholder="Your Bitcoin Account">

                                                            <div class="help-block with-errors"></div>
                                                        </div>
                                                    </div>
                                                   





                                                    <div class="col-md-6">
                                                        <div class="form-group"> <i class="fa fa-key"></i>
                                                            <select  name="type" class="form-control">
                                                                <option value="" selected disabled>Select User Type</option>
                                                                <option value="admin"> Admin </option>
                                                                <option value="user"> User </option>

                                                            </select>
                                                        </div>
                                                    </div>





                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-theme btn-success">Add</button>
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

                                            <table id="example5" class="table ">
                                                <thead>
                                                    <tr>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Type</th>
                                                        <th>Date Joined</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($users as $user)
                                                    <tr>
                                                        <td><a href="{{ url('view-user', $user->id) }}">{{$user->username}}</a></td>
                                                        <td>{{$user->email}}</td>
                                                        <td>{{$user->type}}</td>
                                                        <td>{{ date('F d, Y', strtotime($user->created_at)) }}</td>
                                                        <td style='white-space: nowrap'>
                                                            <button type="button" class="" data-toggle="modal" data-target="#edit{{$user->id}}">
                                                                <i class="fa fa-edit text-success"></i>
                                                            </button>
                                                            <a href="{{ url('view-user', $user->id) }}" class="">
                                                                <i class="fa fa-eye text-warning"></i>
                                                            </a>
                                                            <form  class="deleted" style="display: inline-block!important"  role="form" method="POST"
                                                                   action="{{route('delete-user',['id'=>$user->id])}}" >
                                                                @csrf   
                                                                <button type="submit"class="">
                                                                    <i class="fa fa-trash text-danger"></i>
                                                                </button>
                                                            </form> 
                                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#fund{{$user->id}}">
                                                                <i class="fa fa-dollar-sign">(Manage User Funds)</i>
                                                            </button>
                                                              <a href="{{ url('user-login', $user->id) }}" class="">
                                                                <i class="fa fa-sign-in-alt text-primary"> Login</i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <div class="modal fade" id="edit{{$user->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Edit User</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form class="" method="Post" action="{{route('edit-user',['id'=>$user->id])}}">
                                                                    @csrf  
                                                                    <div class="form-group">
                                                                        <label>Full Name</label>
                                                                        <input type="text" name="full_name" value="{{$user->full_name}}" class="form-control" placeholder="Enter Full Name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Name</label>
                                                                        <input type="text" name="username" value="{{$user->username}}" class="form-control" placeholder="Enter Username">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label>Email</label>
                                                                        <input type="text" name="email" value="{{$user->email}}" class="form-control" placeholder="Enter Name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="">Type</label>

                                                                        <select  name="type" class="form-control">
                                                                            <option value="" selected disabled>Select Type</option>

                                                                            <option value="admin" {{$user->type == 'admin' ? 'selected' : '' }}> Admin </option>
                                                                            <option value="user" {{$user->type == 'user' ? 'selected' : '' }}> User</option>

                                                                        </select>
                                                                    </div>
                                                                     <div class="form-group">
                                                                        <label class="">Can Withdraw</label>

                                                                        <select  name="can_withdraw" class="form-control">
                                                                            <option value="" selected disabled>Select Can Withdraw</option>

                                                                            <option value="0" {{$user->can_withdraw == false ? 'selected' : '' }}> Yes </option>
                                                                            <option value="1" {{$user->can_withdraw == true ? 'selected' : '' }}> No</option>

                                                                        </select>
                                                                    </div>
                                                                     <div class="form-group">
                                                                        <label class="">Can Withdraw Auto</label>

                                                                        <select  name="can_withdraw_auto" class="form-control">
                                                                            <option value="" selected disabled>Select Can Withdraw Auto</option>

                                                                            <option value="0" {{$user->can_withdraw_auto == false ? 'selected' : '' }}> Yes </option>
                                                                            <option value="1" {{$user->can_withdraw_auto == true ? 'selected' : '' }}> No</option>

                                                                        </select>
                                                                    </div>

                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-theme btn-circle">Save</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                <!--//fund-->
                                                <div class="modal fade" id="fund{{$user->id}}">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">

                                                            <div class="modal-header">
                                                                <h4 class="modal-title">Mange Fund</h4>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                <form class="" method="Post" action="{{route('fund',['id'=>$user->id])}}">
                                                                    @csrf  
                                                                    <input name="user_id" type="hidden" value="{{$user->id}}">
                                                                    <div class="form-group">
                                                                        <label class="">Fund Type</label>

                                                                        <select  name="type" class="form-control">
                                                                            <option value="" selected disabled>Select Type</option>

                                                                            <option value="bonus"> Bonus </option>
                                                                            <option value="add"> Add</option>
                                                                            <option value="substract"> Substract</option>

                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="">Coin Type</label>

                                                                        <select  name="coin" class="form-control">
                                                                            <option value="" selected disabled>Select Coin Type</option>
                                                                            @if(!$user->coin->isEmpty())
                                                                            <option value="all"> All Coin </option>
                                                                            @endif
                                                                            @foreach($user->coin as $ucoin)

                                                                            <option value="{{$ucoin->coin_id}}"> {{$ucoin->coin->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label>Amount</label>
                                                                        <input type="text" name="amount" value="" class="form-control" placeholder="Amount">
                                                                    </div>


                                                            </div>
                                                            <div class="modal-footer justify-content-between">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-theme btn-circle btn-success">Send</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                    <!-- /.modal-dialog -->
                                                </div>
                                                @empty
                                                <div class="text-center ">
                                                    <h5 class="grey-text">No User created yet.</h5>
                                                    <img src="{{asset('images/empty.png')}}" style="width: 80px;height: 80px">
                                                </div>

                                                @endforelse
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                <th>Date Joined</th>
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

