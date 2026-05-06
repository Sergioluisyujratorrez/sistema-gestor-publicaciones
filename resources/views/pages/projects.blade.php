@extends('layouts.app')

@section('title', 'Publisys - Todos los proyectos')

@section('content')
  @include('partials.navbar-auth', [
    'headerClass' => 'header-light',
    'headerStyle' => 'border-bottom: 0px solid var(--line); margin-bottom: 0; background: #f8fafc;'
  ])

  <main class="gallery-container">
    <div class="section-head" style="margin-bottom: 0;">
      <h1 style="font-size: 32px; font-weight: 800;">Todos los <span style="color: var(--blue);">proyectos</span></h1>
      <a class="btn btn-warning" href="#">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
        Nuevo Proyecto
      </a>
    </div>
    <p style="color: var(--muted); margin-top: 8px;">Explora y descubre todos los proyectos publicados.</p>

    <div class="gallery-toolbar">
      <div class="tabs">
        <button class="tab active">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
          Todos
        </button>
        <button class="tab">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="14" rx="2"/><path d="M7 8h10M7 12h10M7 16h10"/></svg>
          Sitios web
        </button>
        <button class="tab">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
          Aplicaciones
        </button>
        <button class="tab">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
          Dashboards
        </button>
        <button class="tab">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
          Tiendas online
        </button>
        <button class="tab">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/></svg>
          Otros
        </button>
      </div>

      <div class="gallery-actions">
        <label class="search" style="min-width: 300px;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
          <input type="search" placeholder="Buscar proyectos...">
        </label>
        <select class="select-input" style="width: auto; min-width: 150px;">
          <option>Más recientes</option>
          <option>Más populares</option>
          <option>A-Z</option>
        </select>
      </div>
    </div>

    <div class="gallery-layout">
      <aside class="filters-sidebar">
        <h3>Filtros</h3>
        
        <div class="filter-group">
          <h4>Tipo de proyecto</h4>
          <div class="filter-list">
            <label class="checkbox-group">
              <input type="checkbox" checked>
              Todos
            </label>
            <label class="checkbox-group">
              <input type="checkbox">
              Sitios web
            </label>
            <label class="checkbox-group">
              <input type="checkbox">
              Aplicaciones
            </label>
            <label class="checkbox-group">
              <input type="checkbox">
              Dashboards
            </label>
            <label class="checkbox-group">
              <input type="checkbox">
              Tiendas online
            </label>
            <label class="checkbox-group">
              <input type="checkbox">
              Otros
            </label>
          </div>
        </div>

        <div class="filter-group">
          <h4>Categorías</h4>
          <select class="select-input">
            <option>Todas las categorías</option>
            <option>Fintech</option>
            <option>SaaS</option>
            <option>E-commerce</option>
            <option>Portfolio</option>
          </select>
        </div>

        <div class="filter-group">
          <h4>Tecnologías</h4>
          <select class="select-input">
            <option>Todas las tecnologías</option>
            <option>React</option>
            <option>Vue.js</option>
            <option>Node.js</option>
            <option>Python</option>
          </select>
        </div>

        <div class="filter-group">
          <h4>Fecha</h4>
          <div class="date-inputs">
            <div class="date-field">
              <label>Desde</label>
              <input type="date" class="select-input">
            </div>
            <div class="date-field">
              <label>Hasta</label>
              <input type="date" class="select-input">
            </div>
          </div>
        </div>

        <button class="btn btn-outline btn-block" style="border-color: var(--line); color: var(--text);">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 16px;"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
          Limpiar filtros
        </button>
      </aside>

      <section class="gallery-content">
        <div class="gallery-content-head">
          <span>Mostrando 24 de 42 proyectos</span>
        </div>

        <div class="gallery-grid">
          <x-project-card title="Fintech Dashboard" description="Dashboard administrativo para control de finanzas y analíticas." author="Carlos Mendoza" image-class="admin-preview" avatar-class="avatar-one" type="Dashboard" link="https://fintech-dashboard.com" show-menu />
          <x-project-card title="SaaS Landing Page" description="Landing page moderna para SaaS startup tecnológica." author="María López" image-class="landing-preview" avatar-class="avatar-two" type="Landing page" link="https://saas-landing.com" show-menu />
          <x-project-card title="Portafolio Arquitectura" description="Sitio web minimalista para estudio de arquitectura." author="Juan Pérez" image-class="portfolio-preview" avatar-class="avatar-four" type="Sitio web" link="https://arquitectura-portfolio.com" show-menu />
          <x-project-card title="App Mobile UI" description="Aplicación móvil para gestión de tareas y productividad." author="Carlos Mendoza" image-class="" avatar-class="avatar-one" type="Aplicación" link="https://mobile-ui-kit.com" show-menu image-style="background: linear-gradient(135deg, #1a0f3a, #4422aa);" />
          <x-project-card title="Tienda E-commerce" description="Tienda online moderna con múltiples métodos de pago." author="María López" image-class="" avatar-class="avatar-two" type="Tienda online" link="https://tienda-online.com" show-menu image-style="background: linear-gradient(135deg, #f7f9fc, #d6deea);" />
          <x-project-card title="Lineamientos de marca" description="Sitio web con lineamientos y recursos de marca corporativa." author="Juan Pérez" image-class="thumb-concrete" avatar-class="avatar-four" type="Sitio web" link="https://brand-guidelines.com" show-menu />
        </div>

        <div class="pagination">
          <div class="pag-controls">
            <button class="page-btn" aria-label="Anterior"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg></button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <span class="page-dots">...</span>
            <button class="page-btn">5</button>
            <button class="page-btn" aria-label="Siguiente"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg></button>
          </div>
          <div class="pag-summary" style="display: flex; align-items: center; gap: 12px;">
            <span>Ir a página</span>
            <input type="number" class="select-input" value="1" style="width: 60px; height: 34px; text-align: center;">
          </div>
        </div>
      </section>
    </div>

    <section class="cta-section" style="margin-top: 60px;">
      <div class="cta-icon">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div>
        <h2>&iquest;Tienes un proyecto para compartir?</h2>
        <p>Publica tu proyecto y llega a miles de personas.</p>
      </div>
      <div class="cta-actions">
        <a class="btn btn-primary" href="#">Nuevo proyecto</a>
        <a class="btn btn-outline" href="#">Ver mis proyectos</a>
      </div>
    </section>
  </main>
@endsection
