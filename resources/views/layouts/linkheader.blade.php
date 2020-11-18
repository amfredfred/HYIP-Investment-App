<div class="big-stats">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="left">
                    <h2>USERNAME</h2>
                    <span><i class="fa fa-user-circle-o fa-fw fa-3x"></i></span>
                    <p>{{ucfirst(Auth::user()->username)}}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="mid1">
                    <h2>REGISTERED</h2>
                    <span><i class="fa fa-calendar fa-fw fa-3x"></i></span>
                    <p>{{ date('F d, Y', strtotime(Auth::user()->created_at)) }}</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="right">
                    <h2>IP ADDRESS</h2>
                    <span><i class="	fa fa-map fa-fw fa-3x"> </i></span>
                    @php
                    $clientIP = \Request::ip();
                    @endphp
                    <p>{{$clientIP}}</p>
                </div>
            </div>
 <div class="col-md-3">
                <a href="{{url('referals')}}">
                    <div class="right" style="
                         background: #996600;
                         padding: 15px 0 10px 10px;
                         ">

                        <span style="
                              color: #ffffff;
                              "><i class="fa fa-users fa-fw fa-3x"></i></span>
                        <p style="
                           color: #ffffff;
                           font-weight: 600;
                           text-transform: uppercase;
                           ">Promotion Link</p>
                    </div>
                </a>
            </div>


        </div>

        <div class="row" style="
             padding-top: 10px;
             ">
            <div class="col-md-6">
                <div class="left">
                    <h2>Referral Link</h2>
                    <span><i class="fa fa-link fa-fw fa-3x"></i></span>
                    <p>{{url('register')}}?ref={{Auth::user()->username}}</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="right">
                    <h2>Reffer name</h2>
                    <span><i class="fa fa-handshake-o fa-fw fa-3x"></i></span>
                    <p>
                        @if(empty($name_ref))
                        No reffer found !
                        @else
                        {{$name_ref->user->username}}
                        @endif
                    </p>

                </div>
            </div>
           
        </div>

    </div>
</div>