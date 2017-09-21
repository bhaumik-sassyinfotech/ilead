<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
</head>

<body class="page-header-fixed">
    <header>
        @include('layouts.header')
    </header>
    @yield('content')
    @include('layouts.javascripts')
    <footer class="full">
    @include('layouts.footer')
    </footer>
</body>
</html>