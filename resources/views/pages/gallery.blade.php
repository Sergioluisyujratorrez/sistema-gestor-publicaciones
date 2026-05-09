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
              Otros
            </label>
          </div>
        </div>

        <div class="filter-group">
          <h4>Categorías</h4>
          <select class="select-input">
            <option>Todas las categorías</option>
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
          <span>Mostrando {{ $publicaciones->firstItem() ?? 0 }}–{{ $publicaciones->lastItem() ?? 0 }} de {{ $publicaciones->total() }} publicaciones</span>
        </div>

        @if($publicaciones->isEmpty())
          <div style="text-align:center; padding: 60px 20px; color: var(--muted);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48" style="display:block; margin: 0 auto 16px; opacity:.4;"><rect x="3" y="4" width="18" height="14" rx="2"/><circle cx="9" cy="10" r="2"/><path d="m21 15-5-5-9 9"/></svg>
            <p>Todavía no hay publicaciones activas.</p>
          </div>
        @else
          <div class="gallery-grid">
            @foreach($publicaciones as $publicacion)
              <x-publication-card
                :title="$publicacion->titulo"
                :time="$publicacion->created_at->format('d M Y') . ' • ' . $publicacion->created_at->format('h:i A')"
                :type="ucfirst($publicacion->tipo)"
                :archivo="$publicacion->archivo"
                show-menu
              />
            @endforeach
          </div>

          @if($publicaciones->hasPages())
            <div class="pagination">
              <div class="pag-controls">
                @if($publicaciones->onFirstPage())
                  <button class="page-btn" disabled aria-label="Anterior">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg>
                  </button>
                @else
                  <a class="page-btn" href="{{ $publicaciones->previousPageUrl() }}" aria-label="Anterior">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg>
                  </a>
                @endif

                @foreach($publicaciones->getUrlRange(1, $publicaciones->lastPage()) as $page => $url)
                  <a class="page-btn {{ $page === $publicaciones->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
                @endforeach

                @if($publicaciones->hasMorePages())
                  <a class="page-btn" href="{{ $publicaciones->nextPageUrl() }}" aria-label="Siguiente">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                  </a>
                @else
                  <button class="page-btn" disabled aria-label="Siguiente">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg>
                  </button>
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
