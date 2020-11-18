@section('title')
<title>{{ucfirst($settings['site_name'])}} &mdash; Contact Us</title>
<meta  name="description" content="Contact Us">
<meta itemprop="keywords" name="keywords" content="{{ucfirst($settings['site_name'])}} - Contact Us"/>
<meta name="author" content="{{ucfirst($settings['site_name'])}}" />

@endsection
@extends('layouts.app')
@section('content')

  <main class="contact-us">
        <section>
            <div class="container">
                <div class="form col-sm-10 col-md-7 m-auto shadow-sm p-4">
                    <div class="text-center mb-5">
                        <h3>
                            Send us a Message
                        </h3>
                    </div>
                     <form method="post" id="contact">
                        <fieldset class=" p-3">
                            <div class="form-group">
                                <label for="name">Your Name</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="Jon Snow">
                            </div>
                            <div class="form-group">
                                <label for="email">Your Email</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="officia.jon@gmail.com">
                            </div>
                         
                            <div class="form-group">
                                <label for="message">Your Message</label>
                                <textarea name="message" id="message" class="form-control" placeholder="Message ..."
                                    rows="10"></textarea>
                            </div>
                        </fieldset>

                        <div class="mt-5">
                            <div class="form-group">
                                <button class="btn btn-success px-5">Send Message</button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>



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
                    $(".modal").show();
                },
                complete: function () {
                    $(".modal").hide();

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