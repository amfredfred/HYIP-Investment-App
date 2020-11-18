<div class="col-md-2">
    <div class="menu">
        <!-- Mobile Menu -->
        <div class="d-md-none mb-5 mobile-menu">
            <ul class="nav">
                @can('isUser')
                <li class="nav-item @if(request()->path() == 'home') active @endif">
                    <a class="nav-link" href="{{url('home')}}">Dashboard</a>
                </li>
                <li class="nav-item @if(request()->path() == 'deposit') active @endif">
                    <a class="nav-link" href="{{url('deposit')}}">Invest</a>
                </li>
                <li class="nav-item @if(request()->path() == 'withdraw') active @endif">
                    <a class="nav-link" href="{{url('withdraw')}}">Withdraw</a>
                </li>
                <li class="nav-item @if(request()->path() == 'referals') active @endif">
                    <a class="nav-link" href="{{url('referals')}}">Referrals</a>
                </li>

                @endcan
                @can('isAdmin')
                 <li class="nav-item @if(request()->path() == 'home') active @endif">
                    <a class="nav-link" href="{{url('home')}}">Dashboard</a>
                </li>
                <li class="nav-item @if(request()->path() == 'settings') active @endif">
                    <a class="nav-link" href="{{url('settings')}}">
                        <i class="fa fa-cog menu-icon"></i>
                        <span class="menu-title">Web Settings</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'manage-deposit') active @endif">
                    <a class="nav-link" href="{{url('manage-deposit')}}">
                        <i class="fa fa-money menu-icon"></i>
                        <span class="menu-title">Manage Deposit</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'manage-withdraw') active @endif">
                    <a class="nav-link" href="{{url('manage-withdraw')}}">
                        <i class="fa fa-cog menu-icon"></i>
                        <span class="menu-title">Manage Withdraw</span>
                    </a>
                </li>

                <li class="nav-item @if(request()->path() == 'users') active @endif">
                    <a class="nav-link" href="{{url('users')}}">
                        <i class="fa fa-users menu-icon"></i>
                        <span class="menu-title">Manage Users</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'plan-setting') active @endif">
                    <a class="nav-link" href="{{url('plan-setting')}}">
                        <i class="fa fa-backward menu-icon"></i>
                        <span class="menu-title">Plans Setting</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'compound-setting') active @endif">
                    <a class="nav-link" href="{{url('compound-setting')}}">
                        <i class="fa fa-times-circle menu-icon"></i>
                        <span class="menu-title">Compounds Setting</span>
                    </a>
                </li>
                <li class="nav-item @if(request()->path() == 'coin-setting') active @endif">
                    <a class="nav-link" href="{{url('coin-setting')}}">
                        <i class="fa fa-database menu-icon"></i>
                        <span class="menu-title">Coins Setting</span>
                    </a>
                </li>
                 <li class="nav-item @if(request()->path() == 'compounding') active @endif">
                        <a class="nav-link" href="{{url('compounding')}}">
                            <i class="fa fa-money menu-icon"></i>
                            <span class="menu-title">Compounding</span>
                        </a>
                    </li>
                <li class="nav-item @if(request()->path() == 'mailing') active @endif">
                    <a class="nav-link" href="{{url('mailing')}}">
                        <i class="fa fa-empire menu-icon"></i>
                        <span class="menu-title">Mailing sytyem</span>
                    </a>
                </li>

                @endcan
                <li class="nav-item @if(request()->path() == 'edit_account') active @endif">
                    <a class="nav-link" href="{{url('edit_account')}}"><span class="icon color5"><i class="fa fa-list-alt"></i></span> Edit Account</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" href="{{ route('logout') }}"><span class="icon color5"><i class="fa fa-sign-out"></i></span> Logout</a>
                </li>
            </ul>
        </div>
        <!-- Mobile Menu End -->

        <!-- Desktop Menu -->
        <div class="position-relative desktop-menu">
            <div class="d-none d-md-block">
                <div class="p-3 bg-info text-light shadow-sm rounded mb-3">
                    <span>
                        @if(session()->has('login.content'))
                        Hello,
                        @endif
                    {{Auth::user()->username}}   
                    </span>
                </div>
                <ul class="nav flex-column">
                     @can('isUser')
                    <li class="nav-item @if(request()->path() == 'home') active @endif">
                        <a class="nav-link" href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="nav-item @if(request()->path() == 'deposit') active @endif">
                        <a class="nav-link" href="{{url('deposit')}}"><i class="fa fa-cloud"></i> Make
                            Deposit</a>
                    </li>
                    <li class=" nav-item @if(request()->path() == 'withdraw') active @endif">
                        <a class="nav-link" href="{{url('withdraw')}}"><i class="fa fa-leaf"></i> Withdraw</a>
                    </li>
                    <li class="nav-item @if(request()->path() == 'referals') active @endif">
                        <a class="nav-link" href="{{url('referals')}}"><i class="fa fa-users"></i>
                            Referrals</a>
                    </li>
                   

                    @endcan
                    @can('isAdmin')
                    <li class="nav-item @if(request()->path() == 'home') active @endif">
                        <a class="nav-link" href="{{url('home')}}"><i class="fa fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li class="nav-item @if(request()->path() == 'settings') active @endif">
                        <a class="nav-link" href="{{url('settings')}}">
                            <i class="fa fa-cog menu-icon"></i>
                            <span class="menu-title">Web Settings</span>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->path() == 'manage-deposit') active @endif">
                        <a  class="nav-link" href="{{url('manage-deposit')}}">
                            <i class="fa fa-money menu-icon"></i>
                            <span class="menu-title">All Deposits</span>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->path() == 'manage-withdraw') active @endif">
                        <a class="nav-link" href="{{url('manage-withdraw')}}">
                            <i class="fa fa-cog menu-icon"></i>
                            <span class="menu-title">All Withdraws</span>
                        </a>
                    </li>

                    <li class="nav-item @if(request()->path() == 'users') active @endif">
                        <a class="nav-link" href="{{url('users')}}">
                            <i class="fa fa-users menu-icon"></i>
                            <span class="menu-title">Manage Users</span>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->path() == 'plan-setting') active @endif">
                        <a class="nav-link" href="{{url('plan-setting')}}">
                            <i class="fa fa-backward menu-icon"></i>
                            <span class="menu-title">Plans Setting</span>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->path() == 'compound-setting') active @endif">
                        <a class="nav-link" href="{{url('compound-setting')}}">
                            <i class="fa fa-times-circle menu-icon"></i>
                            <span class="menu-title">Compounds</span>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->path() == 'coin-setting') active @endif">
                        <a class="nav-link"  href="{{url('coin-setting')}}">
                            <i class="fa fa-database menu-icon"></i>
                            <span class="menu-title">Coins Setting</span>
                        </a>
                    </li>
                     <li class="nav-item @if(request()->path() == 'compounding') active @endif">
                        <a class="nav-link" href="{{url('compounding')}}">
                            <i class="fa fa-money menu-icon"></i>
                            <span class="menu-title">Compounding</span>
                        </a>
                    </li>
                    <li class="nav-item @if(request()->path() == 'mailing') active @endif">
                        <a class="nav-link" href="{{url('mailing')}}">
                            <i class="fa fa-empire menu-icon"></i>
                            <span class="menu-title">Mailing sytyem</span>
                        </a>
                    </li>

                    @endcan
                    <li class="nav-item @if(request()->path() == 'edit_account') active @endif">
                        <a class="nav-link" href="{{url('edit_account')}}"><span class="icon color5"><i class="fa fa-list-alt"></i></span> Edit Account</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" href="{{ route('logout') }}"><span class="icon color5"><i class="fa fa-sign-out"></i></span> Logout</a>
                    </li>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>        
                </ul>
            </div>
        </div>
    </div>
</div>
