<!DOCTYPE html>
<html lang="es">
<head>
    @include('partials.meta')
    <title>@yield('title', 'Publisys - Dashboard')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
      .search-bar {
        display: flex;
        gap: 10px;
        align-items: center;
        flex-wrap: wrap;
        margin: 14px 0 16px;
      }
      .search-input-wrap {
        position: relative;
        flex: 1 1 280px;
        min-width: 220px;
      }
      .search-input-wrap svg {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 16px;
        height: 16px;
        color: var(--muted);
        pointer-events: none;
      }
      .search-input,
      .search-select {
        height: 38px;
        background: var(--panel-2);
        border: 1px solid var(--line-strong);
        border-radius: 8px;
        color: var(--text);
        font-size: 13.5px;
        font-family: inherit;
        outline: none;
        transition: border-color 0.18s ease, background 0.18s ease;
      }
      .search-input {
        width: 100%;
        box-sizing: border-box;
        padding: 0 12px 0 36px;
      }
      .search-select {
        padding: 0 14px;
        min-width: 170px;
        appearance: none;
        -webkit-appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%237b87a3' stroke-width='2.4' stroke-linecap='round' stroke-linejoin='round'><polyline points='6 9 12 15 18 9'/></svg>");
        background-repeat: no-repeat;
        background-position: right 12px center;
        padding-right: 32px;
      }
      .search-input:focus,
      .search-select:focus {
        border-color: var(--blue);
        background-color: #0c1633;
      }
      .search-select option { background: var(--panel-2); color: var(--text); }
      .search-bar .btn { height: 38px; }
      .btn-report {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        height: 38px;
        padding: 0 16px;
        background: #dc2626;
        color: #fff;
        border: 1px solid #dc2626;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: background 0.18s ease, border-color 0.18s ease;
      }
      .btn-report:hover { background: #b91c1c; border-color: #b91c1c; color: #fff; }
    </style>
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
