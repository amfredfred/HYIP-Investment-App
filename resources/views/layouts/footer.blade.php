

<footer class="footer">
    <div class="footer-breadcrumbs">
        <div class="container">
            <div class="breadcrumbs-row">
                <ul class="f_breadcrumbs">
                    <li><a href="{{url('/')}}"><span>Home</span></a></li>
                    <li><a href="{{url('pages/about-us')}}"><span>About</span></a></li>
                </ul>
                <div class="scroll-top" id="back-to-top">
                    <div class="scroll-top-text"><span>Scroll to Top</span></div>
                    <div class="scroll-top-icon"><i class="fa fa-angle-up"></i></div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.End of breadcrumbs -->
    <div class="action_btn_inner">
        <a href="{{url('register')}}" class="action_btn">
            <span class="action_title">Register</span>
            <span class="lnr lnr-chevron-right action_icon"></span>
            <span class="action_sub_title">Join the new era of cryptocurrency Investment</span>
        </a>
        <a href="{{url('login')}}" class="action_btn">
            <span class="action_title">Sign in</span>
            <span class="lnr lnr-chevron-right action_icon"></span>
            <span class="action_sub_title">Access the cryptocurrency experience from your dashboard</span>
        </a>
    </div>
    <!-- /.End of action button -->
    <div class="main_footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4">
                    <div class="widget-contact">
                        <ul class="list-icon">
                            <li><i class="fa fa-map-marker"></i>   {{$settings['address']}}</li>
                            <li><i class="fa fa-phone"></i> {{$settings['site_phone']}} </li>
                            <li><i class="fa fa-envelope"></i> <a href="#"><span>{{$settings['site_email']}}</span></a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-sm-5 col-md-4 col-md-offset-1">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="footer-box">
                                <h3 class="footer-title">Our Company</h3>
                                <ul class="footer-list">
                                    <li><a href="{{url('plan')}}">Investment Plan</a></li>
                                    <li><a href="{{url('pages/terms-conditions')}}">Terms of Services</a></li>
                                    <li><a href="{{url('contact-us')}}">Contact Us</a></li>
                                    <li><a href="{{url('pages/about-us')}}">About Us</a></li>
                                    <li><a href="#">24/7 Support</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="footer-box">
                                <h3 class="footer-title">Service</h3>
                                <ul class="footer-list">
                                    <li><a href="{{url('pages/about-us')}}">About Us</a></li>
                                    <li><a href="{{url('pages/terms-conditions')}}">Service</a></li>
                                    <li><a href="{{url('contact-us')}}">Contact us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-md-3">
                    <div class="newsletter-box">

                        <div class="footer-box">
                            <h3 class="footer-title">Downloads</h3>
                            <ul class="footer-list">

                                <li>
                                    <a href="{{url('certificate-of-incorporation')}}"  target="_blank">Certificate of Incorporation</a>
                                </li>
                                <li>
                                    <a href="{{url('confirmation-statement')}}" target="_blank">2020 Confirmation Statement</a>
                                </li>
                                <li>
                                    <a href="{{url('full-accounts')}}"  target="_blank" >2019 Full Accounts</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.End of main footer -->
    <div class="sub_footer">
        <div class="container">
            <div class="logos-wrapper">
                <div class="logos-row">
                    <div class="social-content">
                        <div class="social-row">

                            <div class="social_icon">
                                @foreach($socials as $social)
                                <a href="{{$social->link}}" class=""><i class="{{$social->icon}}"></i></a>
                                @endforeach
                            </div>
                            <div class="f-language">
                                <select class="selectpicker flag_link" data-width="fit">
                                    <option  value="en" data-content='<span class="flag-icon flag-icon-us"></span> English'>English</option>
                                    <option  value="es" data-content='<span class="flag-icon flag-icon-mx"></span> Español'>Español</option>
                                    <option  value="ar" data-content='<span class="flag-icon flag-icon-bd"></span> বাংলা'>বাংলা </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="copyright">
                    <span>  {{ucfirst($settings['site_name'])}} {{$settings['copy_right']}}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- /.End of sub footer -->
</footer>
