<nav class="navbar">
  <a class="brand" href="{{ url('/') }}" aria-label="Publisys inicio">
    <span class="brand-mark">
      <span></span>
      <span></span>
      <span></span>
    </span>
    <span>Publisys</span>
  </a>

  <input class="nav-toggle" type="checkbox" id="nav-toggle" aria-label="Abrir menu">
  <label class="hamburger" for="nav-toggle" aria-hidden="true">
    <span></span>
    <span></span>
    <span></span>
  </label>

  <div class="nav-panel">
    <ul class="nav-links">
      <li><a href="{{ url('/#caracteristicas') }}">Características</a></li>
      <li><a href="{{ route('proyectos') }}">Proyectos</a></li>
      <li><a href="{{ url('/#precios') }}">Precios</a></li>
      <li><a href="{{ route('contacto') }}" class="{{ request()->routeIs('contacto') ? 'active' : '' }}">Contáctame</a></li>
    </ul>
    <div class="nav-actions">
      <a class="btn btn-primary btn-sm" href="{{ route('login') }}">Iniciar sesión</a>
    </div>
  </div>
</nav>
