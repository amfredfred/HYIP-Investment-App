
    <header class="header header--homepage" >
        <article class="overlay">
        <div class="header__navigation ">
            <div class="container-fluid">
                <nav class="navbar navbar-expand-lg navbar-dark px-0">
                    <a class="navbar-brand" href="{{url('/')}}">  <img src="{{asset($settings['logo']) }}" width="100px" alt="{{$settings['site_name']}}"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item active mr-4">
                                <a class="nav-link" href="{{url('/')}}">Home <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item mr-4">
                                <a class="nav-link" href="{{url('pages/about-us')}}">About Us</a>
                            </li>
                            <li class="nav-item mr-4">
                                <a class="nav-link" href="{{url('plan')}}">Investment Plan</a>
                            </li>
                            <li class="nav-item mr-4">
                                <a class="nav-link" href="{{url('faq')}}">FAQs</a>
                            </li>
                            @Auth
                             <li class="nav-item">
                                <a class="nav-link" href="{{url('dashboard')}}">Dashboard</a>
                            </li>
                            @else
                            <li class="nav-item mr-4">
                                <a class="nav-link" href="{{url('login')}}">Log In</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('register')}}">Sign Up</a>
                            </li>
                            @endAuth
                             <li  class="nav-item" id="google_translate_element"></li>
                        </ul>

                    </div>
                </nav>
            </div>
        </div>

        @yield('headerText')
    </article>
    </header>
