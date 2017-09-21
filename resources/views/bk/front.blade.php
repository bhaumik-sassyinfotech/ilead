<!DOCTYPE html>
<html lang="en">

<head>
    @yield('meta')
    @include('head')
</head>

<body class="page-header-fixed">
    <header>
        @include('header')
    </header>
    @yield('content')
    @include('javascripts')
    <footer class="full">
    @include('footer')
    </footer>
</body>
</html>