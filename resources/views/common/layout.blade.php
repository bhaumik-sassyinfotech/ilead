<!DOCTYPE html>
<html lang="en">
<head>
 @yield('head')       
</head>

<body class="page-header-fixed">
    <header>
        @include('common.header')
    </header>
    @yield('content')
    @yield('testimonial')
    @include('common.javascripts')
    
    @yield('javascript')
    <footer class="footer">
    @include('common.footer')
    </footer>
	
	

</body>
</html>