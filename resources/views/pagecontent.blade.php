<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{$cms->meta_description}}">
<meta name="keywords" content="{{$cms->meta_keyword}}">
<meta name="title" content="{{$cms->meta_title}}">
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

<body class="page-header-fixed">
    <header>
 <?php
    $login = Helpers::checkLogin();
?> 

<div class="wrapper">
    <div class="top-header-wrapper">
   <div class="col-xs-3">
    <div class="logo-wrapper ">
        <a href="{{ url('/') }}"><img src="front/images/logo/logo.png" class="img-responsive" alt=""></a>
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
                <div class="inline "><a class="main-btn blue-btn" href="{{url('/signin')}}">Sign In</a></div>
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
    
    <h2>{{$cms->title}}</h2>
    
    {!! $cms->description !!}
    
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
</html>
    

