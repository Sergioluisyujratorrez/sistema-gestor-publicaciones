@extends('layouts.app')

@section('title', 'Publisys - Galería de publicaciones')

@section('content')
  @include('partials.navbar-auth', [
    'headerClass' => 'header-light',
    'headerStyle' => 'border-bottom: 0px solid var(--line); margin-bottom: 0; background: #f8fafc;'
  ])

  <main class="gallery-container">
    <div class="section-head" style="margin-bottom: 0;">
      <h1 style="font-size: 32px; font-weight: 800;">Galería de <span style="color: var(--blue);">publicaciones</span></h1>
      
    </div>
    <p style="color: var(--muted); margin-top: 8px;">Explora y gestiona todo tu contenido publicado en un solo lugar.</p>

    <div class="gallery-toolbar">
      <div class="tabs">
        <button class="tab active">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
          Todas
        </button>
        <button class="tab">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="14" rx="2"/><circle cx="9" cy="10" r="2"/><path d="m21 15-5-5-9 9"/></svg>
          Imágenes
        </button>
        <button class="tab">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><path d="M14 3v6h6"/></svg>
          PDFs
        </button>
        <button class="tab">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
          Proyectos
        </button>
        <button class="tab">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/></svg>
          Otros
        </button>
      </div>

      <div class="gallery-actions">
        <label class="search" style="min-width: 300px;">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
          <input type="search" placeholder="Buscar publicaciones...">
        </label>
        <select class="select-input" style="width: auto; min-width: 150px;">
          <option>Más recientes</option>
          <option>Más antiguos</option>
          <option>A-Z</option>
        </select>
      </div>
    </div>

    <div class="gallery-layout">
      <aside class="filters-sidebar">
        <h3>Filtros</h3>
        
        <div class="filter-group">
          <h4>Tipo de publicación</h4>
          <div class="filter-list">
            <label class="checkbox-group">
              <input type="checkbox" checked>
              Todas
            </label>
            <label class="checkbox-group">
              <input type="checkbox">
              Imágenes
            </label>
            <label class="checkbox-group">
              <input type="checkbox">
              PDFs
            </label>
            <label class="checkbox-group">
              <input type="checkbox">
              Proyectos
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
            <option>Diseño</option>
            <option>Naturaleza</option>
            <option>Documentos</option>
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
          <span>Mostrando 24 de 128 publicaciones</span>
        </div>

        <div class="gallery-grid">
          <x-publication-card title="Montañas nevadas" time="24 May 2024 • 10:30 AM" thumb-class="mountain" avatar-class="avatar-one" show-menu />
          <x-publication-card title="Informe anual 2024" time="23 May 2024 • 04:15 PM" thumb-class="building-dark" avatar-class="avatar-two" type="PDF" show-menu />
          <x-publication-card title="Dashboard UI Kit" time="22 May 2024 • 11:20 AM" thumb-class="dashboard-mini" avatar-class="avatar-three" type="Proyecto" show-menu />
          <x-publication-card title="Olas del océano" time="21 May 2024 • 09:45 AM" thumb-class="ocean" avatar-class="avatar-four" show-menu />
          <x-publication-card title="Guía de marca" time="20 May 2024 • 03:30 PM" thumb-class="concrete" avatar-class="avatar-one" type="PDF" show-menu />
          <x-publication-card title="Sitio web corporativo" time="19 May 2024 • 02:10 PM" thumb-class="ocean" avatar-class="avatar-two" type="Proyecto" show-menu thumb-style="background: linear-gradient(135deg, #aab6c0 0 35%, #263442 35% 100%);" />
        </div>

        <div class="pagination">
          <div class="pag-controls">
            <button class="page-btn" aria-label="Anterior"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg></button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <span class="page-dots">...</span>
            <button class="page-btn">11</button>
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
        <h2>&iquest;Tienes un proyecto que quieras realizar?</h2>
        <p>Contactame para ver como podemos ayudarte a llevarlo a cabo.</p>
      </div>
      <div class="cta-actions">
        <a class="btn btn-outline" href="#">Contactar</a>
      </div>
    </section>
  </main>
@endsection
