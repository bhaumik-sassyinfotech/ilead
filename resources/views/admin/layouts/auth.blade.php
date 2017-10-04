<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.partials.head')
    
    <style>
        .login-bg {
            background: #1a2e61;
        }
    </style>
</head>
<body class="page-header-fixed login-bg">
    <div style="margin-top: 5%; float:left; width: 100%;"></div>
    <div class="container-fluid">
        @yield('content')
    </div>
    <div class="scroll-to-top"
         style="display: none;">
        <i class="fa fa-arrow-up"></i>
    </div>
    @include('admin.partials.javascripts')
</body>
</html>