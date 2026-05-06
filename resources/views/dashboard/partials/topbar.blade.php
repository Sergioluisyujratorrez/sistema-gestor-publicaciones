<header class="topbar">
  <div class="topbar-title">
    <h1>@yield('dashboard-title', 'Dashboard')</h1>
    <p>@yield('dashboard-subtitle', 'Gestiona tu contenido y proyectos')</p>
  </div>

  <label class="search">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
    <input type="search" placeholder="Buscar publicaciones, proyectos...">
  </label>

  <div class="topbar-actions">
    <button class="icon-btn" aria-label="Notificaciones">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9"/><path d="M10 21a2 2 0 0 0 4 0"/></svg>
      <span class="dot"></span>
    </button>

    <div class="user-chip">
      <span class="avatar avatar-one"></span>
      <div class="user-meta">
        <strong>Carlos Mendoza</strong>
        <small>Administrador</small>
      </div>
      <svg class="chev" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m6 9 6 6 6-6"/></svg>
    </div>
  </div>
</header>
