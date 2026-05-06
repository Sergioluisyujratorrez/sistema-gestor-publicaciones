<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.meta')
    <title>@yield('title', 'Publisys - Publicaciones digitales')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body class="@yield('body-class')">
    <main>
        @yield('content')
    </main>

    @section('footer')
        @include('partials.footer')
    @show

    @stack('scripts')
</body>
</html>
