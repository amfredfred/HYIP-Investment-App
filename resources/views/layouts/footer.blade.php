

<footer class="c-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-6 col-sm-4 col-md-3">
                <div class="c-footer-menu">
                    <h5 class="c-footer-menu__heading">

                        Contact
                    </h5>
                    <ul class="list-unstyled">
                        <li class="c-foooter-menu__item">
                            <div class="d-flex">
                                <i class="fa fa-map-marker mr-2 d-block "></i> 

                                <p class="">
                                    {{ucfirst($settings['address'])}}
                                </p>
                            </div>
                        </li>
                        <li class="c-foooter-menu__item">
                            <p>
                                <i class="fa fa-phone mr-2"></i> {{$settings['site_phone']}}
                            </p>
                        </li>
                        <li class="c-foooter-menu__item">
                            <p>
                                <i class="fa fa-envelope mr-2"></i> {{$settings['site_email']}}
                            </p>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-6 col-sm-3 col-md-3">
                <div class="c-footer-menu">
                    <h5 class="c-footer-menu__heading">
                        {{$settings['site_name']}}
                    </h5>
                    <ul class="list-unstyled">
                        <li class="c-foooter-menu__item">
                            <a href="{{url('pages/about-us')}}" class="c-footer-menu__link">About Us</a>
                        </li>
                        <li class="c-foooter-menu__item">
                            <a href="{{url('plan')}}"  class="c-footer-menu__link">Investment Plan</a>
                        </li>
                        <li class="c-foooter-menu__item">
                            <a href="{{url('faq')}}"  class="c-footer-menu__link">FAQs</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-6 col-sm-1 col-md-1">
                <div class="c-footer-menu">
                    <h5 class="c-footer-menu__heading">
                        @Auth
                        Your Account
                        @else
                        Join us
                        @endAuth
                    </h5>
                    <ul class="list-unstyled">
                        @Auth
                        <li class="c-foooter-menu__item">
                            <a href="{{url('dashboard')}}"  class="c-footer-menu__link"> {{Auth::user()->first_name}} {{Auth::user()->last_name}} </a>
                        </li>
                        @else
                        <li class="c-foooter-menu__item">
                            <a href="{{url('login')}}"  class="c-footer-menu__link">Log in</a>
                        </li>
                        <li class="c-foooter-menu__item">
                            <a href="{{url('register')}}"  class="c-footer-menu__link">Sign Up</a>
                        </li>
                        @endAuth
                    </ul>
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-2">
                <div class="c-footer-menu">
                    <h5 class="c-footer-menu__heading">
                        Legal
                    </h5>
                    <ul class="list-unstyled">
                        <li class="c-foooter-menu__item">
                            <a href="{{url('pages/privacy-policy')}}" class="c-footer-menu__link">Privacy Policy</a>
                        </li>
                        <li class="c-foooter-menu__item">
                            <a href="{{url('pages/terms-conditions')}}" class="c-footer-menu__link">Terms & Conditions</a>
                        </li>
                    </ul>
                </div>
            </div>
              <div class="col-6 col-sm-4 col-md-2">
                <div class="c-footer-menu">
                    <h5 class="c-footer-menu__heading">
                        Downloads
                    </h5>
                    <ul class="list-unstyled">
                        <li class="c-foooter-menu__item">
                            <a href="{{url('certificate-of-incorporation')}}"  target="_blank" class="c-footer-menu__link">Certificate of Incorporation</a>
                        </li>
                        <li class="c-foooter-menu__item">
                            <a href="{{url('confirmation-statement')}}" target="_blank" class="c-footer-menu__link">2020 Confirmation Statement</a>
                        </li>
                         <li class="c-foooter-menu__item">
                            <a href="{{url('full-accounts')}}"  target="_blank" class="c-footer-menu__link">2019 Full Accounts</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="c-footer__rights-text">
        <div class="text-center">
            <p>
                {{ucfirst($settings['site_name'])}} {{$settings['copy_right']}}
            </p>
        </div>
    </div>
    <div class="c-footer__social-icons">
        <div class="text-center">
            @foreach($socials as $social)
            <a href="{{$social->link}}" target="_blank" class="c-footer__icon-link">
                <i class="{{$social->icon}}"></i>
            </a>
            @endforeach

        </div>
    </div>
</footer>