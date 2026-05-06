<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.meta')
    <title>@yield('title', 'Publisys - Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @stack('styles')
</head>
<body class="dashboard">
  <div class="app">
    @include('dashboard.partials.sidebar')

    <main class="app-main">
      @include('dashboard.partials.topbar')

      @yield('content')

      @include('dashboard.partials.footer')
    </main>
  </div>

  @stack('scripts')
</body>
</html>
