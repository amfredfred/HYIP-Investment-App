  <header class="cryptobase-header-top-area">
        <div class="header-top-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="header-top-left" style="padding-top: 10px;">
                            <p><i class="fa fa-map"></i>{{$settings['phone_no']}} </p>
                            <p><i class="fa fa-envelope-o"></i><a href="#"><span>{{$settings['site_email']}}</span></a></p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="wallet-btn" style="margin: 8px 0;">
                            <button onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" style="padding: 3px 13px;background: #F44336 none repeat scroll 0 0;border: 1px solid #e43d31; color: white !important; border-radius: 6px; font-size: 15px">Logout</button>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                 @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mainheader-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="sitelogo">
                            <a href="/">
                                <img src="{{asset($settings['logo']) }}" alt="site logo" />
                            </a>
                        </div>
                        <!-- Responsive Menu Start -->
                        <div class="cryptobase-responsive-menu"></div>
                        <!-- Responsive Menu End -->
                    </div>
                    <div class="col-md-7 col-sm-9">
                        <div class="mainmenu">
                            <nav>
                                <ul class="main_menu">
                                    <li class="current-page-item"><a style="color: #fff" href="{{url('/')}}">Home</a></li>
                                    <li ><a style="color: #fff" href="{{url('about')}}">About us</a></li>
                                    <li ><a style="color: #fff" href="{{url('plan')}}">Plans</a></li>
                                    <li ><a style="color: #fff" href="{{url('faq')}}">Faq</a></li>
                                    <li ><a style="color: #fff" href="{{url('contact-us')}}">Support</a></li>
                                 </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-3">
                        <div class="wallet-btn">
                            <a href="{{url('home')}}">dashboard</a>
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </header>


<!--header end-->

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>