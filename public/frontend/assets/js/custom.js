$(document).ready(function () {
    "use strict";
    //Page Loader
    setTimeout(function () {
        $('body').addClass('loaded');
    }, 3000);
    //Page Header Parallax
    $('.page_header').parallaxBackground();
    //Crypto Table
    $('#cryptoTable').DataTable({
        responsive: true
    });
    //Forex Table
    $('#forexTable').DataTable({
        responsive: true
    });
    //Stocks Table
    $('#stocksTable').DataTable({
        responsive: true
    });
    //Dtatable Tab
    $("a[data-toggle=\"tab\"]").on("shown.bs.tab", function (e) {
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
    });
    //Dtatable Link
    $('.table').on('click', 'tbody tr', function () {
        window.location.href = $(this).data('href');
    });
    //Popup Video
    $('.popup-youtube').magnificPopup({
        disableOn: 700,
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });
    //Accordion
    $('.accordion > li:eq(0) a').addClass('active').next().slideDown();
    $('.accordion a').on('click', function (j) {
        var dropDown = $(this).closest('li').find('p');

        $(this).closest('.accordion').find('p').not(dropDown).slideUp();

        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        } else {
            $(this).closest('.accordion').find('a.active').removeClass('active');
            $(this).addClass('active');
        }

        dropDown.stop(false, true).slideToggle();

        j.preventDefault();
    });
    //Back to top
    $('#back-to-top').on('click', function () {
        $('html,body').animate({
            scrollTop: 0
        }, 700);
    });
    //Slider
    $("#animation-slide").owlCarousel({
        items: 1,
        loop: true,
        autoplay: true,
        dots: true,
        nav: true,
        autoplayTimeout: 5000,
        navText: ["<i class='lnr lnr-chevron-left'></i>", "<i class='lnr lnr-chevron-right'></i>"],
        //                    animateIn: "fadeInRight",
        //                    animateOut: "fadeOutLeft",
        autoplayHoverPause: false,
        touchDrag: true,
        mouseDrag: true
    });
    $("#animation-slide").on("translate.owl.carousel", function () {
        $(this).find(".owl-item .slide-text > *").removeClass("fadeInUp animated").css("opacity", "0");
        $(this).find(".owl-item .slide-img").removeClass("fadeInRight animated").css("opacity", "0");
    });
    $("#animation-slide").on("translated.owl.carousel", function () {
        $(this).find(".owl-item.active .slide-text > *").addClass("fadeInUp animated").css("opacity", "1");
        $(this).find(".owl-item.active .slide-img").addClass("fadeInRight animated").css("opacity", "1");
    });
    //Blog
    $('.owl-blog').owlCarousel({
        loop: true,
        dots: false,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 4
            }
        }
    });
    //Testimonial
    $('.owl-testimonial').owlCarousel({
        loop: true,
        dots: false,
        nav: true,
        navText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            768: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
    //Selectpicker
    $('.selectpicker').selectpicker({
        style: ''
    });
    //Marquee
    $('#marquee-horizontal').marquee({direction: 'horizontal', delay: 0, timing: 15});

// Test Less More
    // Configure/customize these variables.
    var showChar = 550; // How many characters are shown by default
    var ellipsestext = "...";
    var moretext = "Show more >";
    var lesstext = "Show less";

    $(".more").each(function () {
        var content = $(this).html();

        if (content.length > showChar) {
            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);

            var html =
                    c +
                    '<span class="moreellipses">' +
                    ellipsestext +
                    '&nbsp;</span><span class="morecontent"><span>' +
                    h +
                    '</span>&nbsp;&nbsp;<a href="" class="morelink">' +
                    moretext +
                    "</a></span>";

            $(this).html(html);
        }
    });

    $(".morelink").on('click', function () {
        if ($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this)
                .parent()
                .prev()
                .toggle();
        $(this)
                .prev()
                .toggle();
        return false;
    });

});