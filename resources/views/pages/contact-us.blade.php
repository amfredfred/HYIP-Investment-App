@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Contact Us</title>
<meta  name="description" content="Contact Us">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Contact Us"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('content')
<div class="page_header" data-parallax-bg-image="{{asset('frontend/assets/img/1920x650-5.jpg')}}" data-parallax-direction="">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-sm-offset-2">
                    <div class="haeder-text">
                        <h1>Contact Us</h1>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--  /.End of page header -->
<div class="contact_content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-5 col-md-5 p_r_40">
                        <h1 class="contact_title">Contact</h1>
                        <div class="contacts_info">
                            <div class="address">
                                <p>{{$settings['address']}}</p>
                            </div>
                            <div class="phone_fax">
                                <div>
                                    <p>Phone</p>
                                    <p>Email</p>
                                </div>
                                <div>
                                    <a href="#">{{$settings['site_phone']}}</a>
                                    <a href="#">{{$settings['site_email']}}</a>
                                </div>
                            </div>
                            <ul class="opening_hours">
                                <li>
                                    <p>Monday-Wednesday</p>
                                    <p>10 am - 6 pm</p>
                                </li>
                                <li>
                                    <p>Thursday-Friday</p>
                                    <p>10 am - 9 pm</p>
                                </li>
                                <li>
                                    <p>Saturday</p>
                                    <p>9:30 am - 5 pm</p>
                                </li>
                                <li>
                                    <p>Sunday</p>
                                    <p>12 pm - 5 pm</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-7 col-md-5 p_l_40">
                        <form class="contact_form"  id="contact">
                            <h1 class="contact_title">By email</h1>
                            <div class="form-group">
                                <label>Name</label>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="name">
                                        <p class="help-block">Full Name</p>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>Email*</label>
                                        <input type="email" class="form-control" id="email">
                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label>Message*</label>
                                <textarea class="form-control" rows="7" id="message"></textarea>
                            </div>
                            <button type="submit" id="sign" class="btn btn-default">Get In Touch</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>




<!--map end-->
@section('script')
<script>
    /*
     login
     */
    $('#contact').submit(function (event) {
        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function () {
                let disable = document.getElementById('sign');
                disable.setAttribute('disabled', 'true');
            },
            complete: function () {
                let enable = document.getElementById('sign');
                enable.removeAttribute('disabled', 'true');

            }
        });
        jQuery.ajax({
            url: "{{url('/contact')}}",
            type: 'POST',
            data: {
                name: jQuery('#name').val(),
                email: jQuery('#email').val(),
                action: jQuery('#action').val(),
                message: jQuery('#message').val()


            },
            success: function (data) {
                if (data.status === 401) {
                    jQuery.each(data.message, function (key, value) {
                        var message = ('' + value + '');
                        toastr.options.onHidden = function () {
                            //  window.location.href = "{{url('/register')}}";
                        };
                        toastr.error(message, {timeOut: 50000});
                    });
                    return false;
                }
                if (data.status === 200) {
                    var message = data.message;
                    toastr.options.onHidden = function () {
                        // window.location.href = "{{url('/user/home')}}";
                    };
                    toastr.success(message, {timeOut: 50000});
                    $("#contact")[0].reset();
                    return false;
                }
            }

        });
    });

</script> 
@endsection
@endsection