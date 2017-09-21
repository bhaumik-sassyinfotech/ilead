@extends('common.layout')
@include('common.head')

@section('content')

<section class="hero-section">
    <div class="hero-img">
        <div class="tree-wrp">
            <div class="tree">
<!--                <img src="front/images/texture/tree.png" class="img-responsive animated rubberBand" alt="">-->
            </div>
        </div>
        <div class="lower-icon-wrap">
            <div class="ic-wrapper">
                <div class="bowling">
                    <img src="front/images/texture/bowling.png" class="img-responsive animated rubberBand" alt="">
                </div>
                <div class="whale">
                    <img src="front/images/texture/whale.png" class="img-responsive animated rubberBand" alt="">
                </div>
            </div>
        </div>
        <div class="home-video-section">
            <div class="video video-bg">
                <div id="hero-video"></div>
            </div>
            <div class="video-overlay"></div>			
        </div>
<!--        <img src="front/images/hero-img.jpg" class="img-responsive herobanner" alt="">-->
    </div>
</section>
<section class="second-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="button-wrapper">
                    <div class="btn-tbl">
                        <div class="btn-cell">
                            <div class="default-btn lg-btn pull-left"><a href="#">App Coming Soon on <span class="apple-icon inline"><img src="front/images/Apple-app-icon.png" class="img-responsive" alt=""></span> <span class="andriod-icon inline"><img src="front/images/Android-App-Icon.png" class="img-responsive" alt=""></span> </a></div>
                        </div>
                        <div class="btn-cell">
                            <div class="default-btn baby-pink-btn md-btn"><a href="#">Parent - Register</a></div>
                        </div>
                        <div class="btn-cell">
                            <div class="default-btn md-btn  baby-yellow-btn pull-right"><a href="#">Sitter - Apply</a></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="third-section">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="sub-title">
                    <h2 class="care-text-heading">The Care You Need, When You Need It</h2>
                    <div class="underline"></div>
                </div>
                <h3 class="sub-txt">Safely connect with a community of trusted Sitters in your neighbourhood.</h3>

            </div>
            <div class="col-xs-12">

            </div>
        </div>
    </div>
</section>
<section class="fouth-section">        
    <div class="container-fluid">
        <div class="row">
            <div class="choose_slider">

                <div class="choose_slider_items">
                    <div class="heading-wrapper">

                        <div class="sub-title">
                            <h2>We’ve Got This</h2>
                            <div class="underline"></div>
                        </div>
                    </div>
                    <ul id="mySlider2">
                        <li class="current_item">
                            <div class="got-this">
                                <div class="got-this__img">
                                    <img src="front/images/texture/chat-icon.png" class="img-responsive" alt="">
                                </div>
                                <h3>Chat with your Sitter</h3>
                                <p>The care you need, when you need it. Instant connection with sitters in your area</p>
                            </div>
                        </li>
                        <li class="current_item">
                            <div class="got-this">
                                <div class="got-this__img">
                                    <img src="front/images/texture/video-call-icon.png" class="img-responsive" alt="">
                                </div>
                                <h3>Live in Home Video</h3>
                                <p>The care you need, when you need it. Instant connection with sitters in your area</p>
                            </div>
                        </li>
                        <li class="current_item">
                            <div class="got-this">
                                <div class="got-this__img">
                                    <img src="front/images/texture/clock.png" class="img-responsive" alt="">
                                </div>
                                <h3>On Demand</h3>
                                <p>The care you need, when you need it. Instant connection with sitters in your area</p>
                            </div>
                        </li>
                        <li class="current_item">
                            <div class="got-this">
                                <div class="got-this__img">
                                    <img src="front/images/texture/location-icon.png" class="img-responsive" alt="">
                                </div>
                                <h3>Monitor your Sitter’s Location</h3>
                                <p>The care you need, when you need it. Instant connection with sitters in your area</p>
                            </div>
                        </li>
                        <li class="current_item">
                            <div class="got-this">
                                <div class="got-this__img">
                                    <img src="front/images/texture/card-icon.png" class="img-responsive" alt="">
                                </div>
                                <h3>Cashless Transactions</h3>
                                <p>The care you need, when you need it. Instant connection with sitters in your area</p>
                            </div>
                        </li>



                    </ul>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="navigation">
                    <div><a id="btn_next2" href="#"><img src="front/images/texture/arrow-lft.png" class="img-responsive" alt=""></a></div>
                    <div><a id="btn_prev2" href="#"><img src="front/images/texture/arrow-rgt.png" class="img-responsive" alt=""></a></div>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="fifth-section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="fifth-sec-tbl inline-parent">
                    <div class="fifth-sec-cell inline">
                        <div class="slide-img">
                            <img src="front/images/texture/Phone.png" class="img-responsive" alt="">
                        </div>
                    </div>
                    <div class="fifth-sec-cell inline">                          
                        <div class="sub-title">
                            <h2>You’re in Safe Hands</h2>
                            <div class="underline"></div>
                        </div>
                        <div class="text-wrp-testi">
                            <p>Trust and safety are the fundamental building blocks of Mumma Co – and our first priority. Whether you are requesting sitting services, or offering them, our 
                                standards underpin all that we do. We are committed to creating a safe & trusted 
                                community and that’s why our <span class="underline">4-step vetting process</span> and <span class="underline">in-app functionality</span> will provide you with absolute <span class="ff-su">peace of mind</span> during your experience. </p>
                            <p>It’s a lot of work – the kind busy parents don’t always have time for - 
                                and we’re happy we can do it for you.</p>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

</section>
<section class="price-happy">
    <div class="container">
        <div class="col-xs-12">
            <div class="heading-wrapper">
                <div class="sub-title">
                    <h2 class="small-size">Priced to Make You Smile</h2>
                    <div class="underline"></div>
                </div>
            </div>
            <div class="icon-happy-talk-wrapper">
                <div class="in-parent">
                    <div class="in">
                        <div class="icon-wrp">
                            <img src="front/images/priced1.png" class="img-responsive" alt="">
                        </div>
                        <div class="info-txt">
                            No Subscriptions
                        </div>
                    </div>
                    <div class="in">
                        <div class="icon-wrp">
                            <img src="front/images/priced2.png" class="img-responsive" alt="">
                        </div>
                        <div class="info-txt">
                            No Hidden Fees
                        </div>                                

                    </div>
                    <div class="in">
                        <div class="icon-wrp">
                            <img src="front/images/priced3.png" class="img-responsive" alt="">
                        </div>
                        <div class="info-txt">
                            $25 Per hour
                        </div>
                    </div>
                    <div class="in">
                        <div class="icon-wrp">
                            <img src="front/images/priced4.png" class="img-responsive" alt="">
                        </div>
                        <div class="info-txt">
                            Cashless Payments
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('testimonial')
@include('common.testimonial')
@endsection
@section('javascript')
<script>
    $(function () {
         //promoteSlider();
    });

</script>
<script>
    $('.dwn-appslider').owlCarousel({
        nav: true,
        loop: true,
        navText: ["", ""],
        dots: false,
        items: 1
    });

    $('.testimonial-slider').owlCarousel({
        nav: true,
        loop: true,
        dots: false,
        navText: ["", ""],
        //   animateOut: 'fadein',
        animateIn: 'bounceIn',
        smartSpeed: 450,

        items: 1
    })
</script>
<script>

    jwplayer('hero-video').setup({
        file: "front/video/sample.mp4",
        image: "front/images/hero-img.jpg",
        width: "100%",
        height: "100%",
        stretching: "fill",
        controlbar: "none",
        autostart: "true",
        mute: "false",
        repeat: "always",
        flashplayer: "http://cdn.jsdelivr.net/jwplayer/5.10/player.swf"
    });


    $(function () {


        $("#mySlider2").AnimatedSlider({prevButton: "#btn_prev2",
            nextButton: "#btn_next2",
            visibleItems: 5,

            infiniteScroll: true,
            willChangeCallback: function (obj, item) {
            },
            changedCallback: function () {
                $('.previous_hidden').css('opacity', 1);
            }
        });
    });
</script>
@endsection