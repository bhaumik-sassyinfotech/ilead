<?php $meta = Helpers::getmeta(); ?>
@section('head')
<title>{{$meta->website_title}}</title>
<meta name="description" content="{{$meta->meta_description}}">
<meta name="keywords" content="{{$meta->meta_keyword}}">
<meta name="title" content="{{$meta->meta_title}}">

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- Latest compiled and minified CSS -->
<!-- Bootstrap -->
<link href="front/css/normalize.css" rel="stylesheet" type="text/css">
<link href="front/css/font-awesome.css" rel="stylesheet" type="text/css">
<link href="front/css/bootstrap.css" rel="stylesheet" type="text/css">

<!-- Owlslider -->
<link rel="stylesheet" type="text/css" href="front/js/vendor/owl/owlcarousel/assets/owl.carousel.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="front/js/vendor/owl/owlcarousel/assets/owl.theme.green.min.css" media="all" />
<link rel="stylesheet" type="text/css" href="front/js/vendor/cssslider/animated-slider.css" media="all" />
<link rel="stylesheet" type="text/css" href="front/js/vendor/date-picker/bootstrap-datepicker.css" media="all" />
<link rel="stylesheet" type="text/css" href="front/css/style.css" media="all" />
<link rel="stylesheet" type="text/css" href="front/css/custome-responsive-style.css" media="all" />
<link rel="stylesheet" type="text/css" href="front/css/fonts.css" media="all" />
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet"> 

<link rel="stylesheet" type="text/css" href="front/css/animate.css">

<!--<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>-->

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> --> 
@endsection