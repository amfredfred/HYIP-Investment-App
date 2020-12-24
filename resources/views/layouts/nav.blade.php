   <nav class="navbar navbar-default navbar-fixed navbar-transparent bootsnav">
            <!-- Start Top Search -->
            <div class="top-search">
                <div class="container">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                    </div>
                </div>
            </div>
            <!-- End Top Search -->
            <div class="container">            
                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="nav-language">
                            <select class="selectpicker flag_link" data-width="auto">
                                <option  value="en" data-content='<span class="flag-icon flag-icon-us"></span> English'>English</option>
                                <option  value="es" data-content='<span class="flag-icon flag-icon-mx"></span> Español'>Español</option>
                                <option  value="ar" data-content='<span class="flag-icon flag-icon-bd"></span> বাংলা'>বাংলা </option>
                            </select>
                        </li>
                        <li  id="google_translate_element" style="display: none"></li>
                        <li><a href="{{url('login')}}" class="btn nav-btn">Login</a></li>
                        <li><a href="{{url('register')}}" class="btn nav-btn btn-orange">Sign Up</a></li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset($settings['logo']) }}" class="logo" alt="">logo</a>
                    <span class=" hidden-lg hidden-md">
                    <li class="nav-language" style="display: inline-block!important; height: 1px!important">
                            <select class="selectpicker flag_link" data-width="auto">
                                <option  value="en" data-content='<span class="flag-icon flag-icon-us"></span> English'>English</option>
                                <option  value="es" data-content='<span class="flag-icon flag-icon-mx"></span> Español'>Español</option>
                                <option  value="ar" data-content='<span class="flag-icon flag-icon-bd"></span> বাংলা'>বাংলা </option>
                            </select>
                        </li>
                    </span>
                </div>
                <!-- End Header Navigation -->
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav" data-in="" data-out="">
                        <li class="@if(request()->path() == '/') active @endif"><a href="{{url('/')}}">Home</a></li>
                        <li class="@if(request()->path() == 'plan') active @endif"><a href="{{url('plan')}}">Investment Plan</a></li>
                        <li class="@if(request()->path() == 'pages/about-us') active @endif"><a href="{{url('pages/about-us')}}">About Us</a></li>
                        <li class="@if(request()->path() == 'contact-us') active @endif"><a href="{{url('contact-us')}}">Contact Us</a></li>
                          <li class="@if(request()->path() == 'faq') active @endif"><a href="{{url('faq')}}">FAQs</a></li>
                          <li><a href="{{url('login')}}" class=" hidden-lg hidden-md @if(request()->path() == 'login') active @endif">Login</a></li>
                        <li><a href="{{url('register')}}" class="hidden-lg hidden-md @if(request()->path() == 'register') active @endif">Sign Up</a></li>
                      
                       
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div>    
        </nav>

