<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{$cms->meta_description}}">
<meta name="keywords" content="{{$cms->meta_keyword}}">
<meta name="author" content="{{$cms->meta_title}}">
<title>Clique chat</title>

<!-- Latest compiled and minified CSS -->
<!-- Bootstrap -->
<link href="front/css/normalize.css" rel="stylesheet" type="text/css">
<link href="front/js/vendor/owl/owl.carousel.min.css" rel="stylesheet" type="text/css">
<link href="front/js/vendor/owl/owl.theme.default.css" rel="stylesheet" type="text/css">
<link href="front/css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="front/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="front/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="front/css/custome-responsive-style.css" media="all" />

<!--Fonts-->
<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="front/css/fonts.css" media="all" />
<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	
</head>

<body class="login-wrapper">
<?php
    $login = Helpers::checkLogin();
?>
    <header>
  

<div class="wrapper">
    <div class="top-header-wrapper">
   <div class="col-xs-3">
    <div class="logo-wrapper ">
        <a href="#"><img src="front/images/logo/logo.png" class="img-responsive" alt=""></a>
    </div>
    </div>
    <div class="col-xs-9">
    <div class="nav-wrapper tbl  ">
        <nav class="cell slidein">
            <ul class="nolist">
                <li><a href="#">Upgrade Now</a></li>
                <li><a href="#">Promote A Room</a></li>
                <li><a href="#">Store</a></li>
                <li><a href="#">Live Directory</a></li>
            </ul>
        </nav>
        <div class="button-wrapper cell">
            <div class="inline-parent">
                <div class="inline "><a class="main-btn blue-btn" href="#">Instant Room</a></div>
                <?php
                    if($login == 1) {
                ?>
                <div class="inline "><a class="main-btn blue-btn" onclick="$('#logout').submit();" href="#">Logout</a></div>
                <?php } else { ?>
                <div class="inline "><a class="main-btn blue-btn" href="javascripts:void(0);">Sign In</a></div>
                <?php
                }
                ?>
                
                <div class="inline mobile-menu"><div id="nav-icon3">
  <span></span>
  <span></span>
  <span></span>
  <span></span>
</div></div>
            </div>
        </div>
    </div>
    </div>
</div>

</div>
</header>
{!! Form::open(['url' => 'logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">Logout</button>
{!! Form::close() !!}
    
<main class="full mt100">
        <section class="main-spacing full">
            @if (Session::has('success'))
                <div class="alert alert-success">{!! Session::get('success') !!}</div>
            @endif
            @if (Session::has('failure'))
                <div class="alert alert-danger">{!! Session::get('failure') !!}</div>
            @endif
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 ">
                        <h2 class="block-center login-title">Create Your Own Chat Room</h2>

                    </div>
                </div>
            </div>
            <div class="container">
                <?php
                    //echo "login : ".$cms->login;
                ?>
                <div id="login" class="carousel slide" data-ride="carousel">
                    <ul class="nav nav-pills nav-justified">
                        <li data-target="#login" data-slide-to="0" class="active"><a id="register_btn" href="#">Join Clique</a></li>
                        <li data-target="#login" data-slide-to="1"><a id="login_btn" href="#">Sign In</a></li>
                    </ul>
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <a href="#" class="main-btn fb-spacing facebookbtn btnlg ">SIGN IN WITH FACEBOOK</a>
                            <div class="regular-way-txt">
                                <p class="block-center">Or Regular Way</p>
                            </div>
                            <form action="{{ url('register') }}" method="post" name="register" id="register">
                                <input type="hidden" id="active_register" name="active_register" value="1">
                                <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">
                                <input type="text" placeholder="username" name="username" id="username">
                                @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                                @endif
                                <input type="email" placeholder="Email Id" name="email" id="email">
                                 @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                <input type="password" placeholder="password" name="password" id="password">
                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                                <div class="chk-tbl">
                                    <div class="chk-cell"><div class="choice-chkbox"> <input value="None" id="yes" name="" checked="" type="checkbox">
                                    <label for="yes"></label>
                                </div></div>
                                <div class="chk-cell"> <label for="yes">Sign Up to receive regular updates, announcements &
Other promotions. We respect your privacy.</label></div>
                                </div>
                                <input class="main-btn fb-spacing bluelogin-btn btnlg" name="save" id="save" type="submit" value="JOIN THE COMMUNITY">
                            </form>
                       
                        </div>
                        <!-- End Item -->

                        <div class="item">

                           
                            <a href="#" class="main-btn fb-spacing facebookbtn btnlg ">SIGN IN WITH FACEBOOK</a>
                            <div class="regular-way-txt">
                                <p class="block-center">Or Regular Way</p>
                            </div>
                            <form action="{{ url('signin') }}" name="login" id="login" method="post">
                                <input type="hidden" id="active_register" name="active_register" value="0">
                                <input type="hidden"
                               name="_token"
                               value="{{ csrf_token() }}">
                                <input type="text" placeholder="email" name="login_email" id="login_email">
                                @if ($errors->has('login_email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('login_email') }}</strong>
                                </span>
                                @endif
                                <input type="password" placeholder="password" name="login_password" id="login_password">
                                @if ($errors->has('login_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('login_password') }}</strong>
                                </span>
                                @endif
                                <div class="chk-tbl remmber-wrp">
                                    <div class="chk-cell"><div class="choice-chkbox"> <input value="None" id="remmber" name="" checked="" type="checkbox">
                                    <label for="remmber"></label>
                                </div></div>
                                <div class="chk-cell"> <label for="remmber">Remember Me</label></div>
                                </div>
                                <input class="main-btn fb-spacing bluelogin-btn btnlg" name="submit" id="submit" type="submit" value="JOIN THE COMMUNITY">
                            </form>
                            <p class="block-center">Forgot Your Password? <a href="#">Recover Here</a></p>
                        </div>
                        <!-- End Item -->


                    </div>
                    <!-- End Carousel Inner -->
                </div>
                <p class="note">Tinychat has a strict policy regarding copyright violation, nudity and other items you can find in the terms of use. If you do not follow the terms, you will be banned from the site. By registering on tinychat.com you automatically agree to the Terms of use.</p>
                <!-- End Carousel -->
            </div>
        </section>
    </main>    

<footer class="full">
    <div class="wrapper ">
<div class="full">
<div class="col-md-7 col-xs-12">
    <div class="inline-parent">
        <div class="inline">
            <ul class="nolist footer-link">
    <li><a href="{{url('/safety-support')}}">Safety & Support</a></li>
    <li><a href="{{url('/privacy-policy')}}">Privacy Policy</a></li>
    <li><a href="{{url('/terms-conditions')}}">Terms & Conditions</a></li>
</ul>
        </div>
        <div class="inline">
            <ul class="nolist social">
                <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
            </ul>
        </div>
    </div>
</div>
<div class="col-md-5 col-xs-12">
   <div class="copywrapper">
        <p>© 2017 - Clique.Chat</p>
   </div>
   
</div>
</div>
</div>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> --> 
<script src="front/js/jquery.min.js"></script> 
<script src="front/js/bootstrap.js"></script> 
<script src="front/js/vendor/owl/owl.carousel.min.js"></script> 
<script src="front/js/vendor/tabs/zozo.tabs.min.js"></script> 
<!--<script src="js/vendor/tabs/jquery.easing.min.js"></script> -->
<script src="front/js/custom.js"></script> 
    </footer>
</body>
<script>
        $(document).ready(function() {
            $('#login').carousel({
                interval: false
            });

            var clickEvent = false;
            $('#login').on('click', '.nav a', function() {
                clickEvent = true;
                $('.nav li').removeClass('active');
                $(this).parent().addClass('active');
            }).on('slid.bs.carousel', function(e) {
                if (!clickEvent) {
                    var count = $('.nav').children().length - 1;
                    var current = $('.nav li.active');
                    current.removeClass('active').next().addClass('active');
                    var id = parseInt(current.data('slide-to'));
                    if (count == id) {
                        $('.nav li').first().addClass('active');
                    }
                }
                clickEvent = false;
            });
        });

    </script>
</html>