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
          <span>Mostrando {{ $proyectos->firstItem() ?? 0 }}–{{ $proyectos->lastItem() ?? 0 }} de {{ $proyectos->total() }} proyectos</span>
        </div>

        @if($proyectos->isEmpty())
          <div style="text-align:center; padding: 60px 20px; color: var(--muted);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48" style="display:block; margin: 0 auto 16px; opacity:.4;"><rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/></svg>
            <p>Todavía no hay proyectos publicados.</p>
          </div>
        @else
          <div class="gallery-grid">
            @foreach($proyectos as $proyecto)
              <x-project-card
                :title="$proyecto->titulo"
                :description="$proyecto->descripcion ?? ''"
                :author="$proyecto->user->name ?? 'Administrador'"
                :type="str_replace('_', ' ', ucfirst($proyecto->tipo))"
                :link="$proyecto->enlace ?? ''"
                :imagen="$proyecto->imagen"
                show-menu
              />
            @endforeach
          </div>

          @if($proyectos->hasPages())
            <div class="pagination">
              <div class="pag-controls">
                @if($proyectos->onFirstPage())
                  <button class="page-btn" disabled aria-label="Anterior"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg></button>
                @else
                  <a class="page-btn" href="{{ $proyectos->previousPageUrl() }}" aria-label="Anterior"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg></a>
                @endif

                @foreach($proyectos->getUrlRange(1, $proyectos->lastPage()) as $page => $url)
                  <a class="page-btn {{ $page === $proyectos->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
                @endforeach

                @if($proyectos->hasMorePages())
                  <a class="page-btn" href="{{ $proyectos->nextPageUrl() }}" aria-label="Siguiente"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg></a>
                @else
                  <button class="page-btn" disabled aria-label="Siguiente"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg></button>
                @endif
              </div>
            </div>
          @endif
        @endif
      </section>
    </div>

    <section class="cta-section" style="margin-top: 60px;">
      <div class="cta-icon">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div>
        <h2>&iquest;Tienes un proyecto que quieras realizar?</h2>
        <p>Contactame para ver como podemos ayudarte a llevarlo a cabo.</p>
      </div>
      <div class="cta-actions">
        <a class="btn btn-outline" href="#">Contactar</a>
      </div>
    </section>
  </main>
@endsection
