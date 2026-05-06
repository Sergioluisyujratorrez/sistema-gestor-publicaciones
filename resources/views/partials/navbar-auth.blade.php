<header class="navbar {{ $headerClass ?? '' }}" style="{{ $headerStyle ?? '' }}">
  <a class="brand" href="{{ route('home') }}" aria-label="Publisys inicio">
    <span class="brand-mark">
      <span></span>
      <span></span>
      <span></span>
    </span>
    <span>Publisys</span>
  </a>

  <div class="nav-panel">
    <ul class="nav-links">
      <li><a href="{{ url('/#caracteristicas') }}">Características</a></li>
      <li><a href="{{ route('proyectos') }}" class="{{ request()->routeIs('proyectos') ? 'active' : '' }}">Proyectos</a></li>
      <li><a href="{{ url('/#precios') }}">Precios</a></li>
      <li><a href="{{ route('contacto') }}" class="{{ request()->routeIs('contacto') ? 'active' : '' }}">Contáctame</a></li>
    </ul>
    <!-- <div class="nav-actions">
      <button class="icon-btn" aria-label="Notificaciones" style="background: transparent; border-color: var(--line);">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width: 18px; height: 18px;"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10 21a2 2 0 0 0 4 0"/></svg>
      </button>
      <div class="user-chip">
        <span class="avatar avatar-one"></span>
        <div class="user-meta">
          <strong>Carlos Mendoza</strong>
          <small>Administrador</small>
        </div>
        <svg class="chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 14px; height: 14px;"><path d="m6 9 6 6 6-6"/></svg>
      </div>
    </div> -->
  </div>
</header>
