@extends('layouts.app')

@section('title', 'Publisys - Galería de publicaciones')

@push('styles')
<style>
  .thumb-clickable:hover img { transform: scale(1.03); transition: transform 0.25s ease; }
  .thumb-clickable:hover { filter: brightness(0.97); }
  .card-title-row h3[onclick]:hover { color: var(--blue); }

  .viewer-overlay {
    position: fixed; inset: 0;
    background: rgba(0,0,0,.78);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 24px;
  }
  .viewer-overlay[style*="flex"] { display: flex !important; }

  .viewer-box {
    background: #fff;
    border-radius: 12px;
    width: min(1100px, 100%);
    max-height: 92vh;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    box-shadow: 0 24px 64px rgba(0,0,0,.5);
  }

  .viewer-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 20px;
    border-bottom: 1px solid #e5e7eb;
  }
  .viewer-header h3 { margin: 0; font-size: 16px; font-weight: 700; color: #111827; }

  .viewer-close {
    width: 36px; height: 36px;
    border: 0; background: transparent;
    font-size: 26px; color: #6b7280; cursor: pointer; line-height: 1;
    border-radius: 6px;
  }
  .viewer-close:hover { background: #f3f4f6; color: #111827; }

  .viewer-body {
    flex: 1;
    background: #0f172a;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 60vh;
    overflow: auto;
  }
  .viewer-body img { max-width: 100%; max-height: 86vh; display: block; }
  .viewer-body iframe { width: 100%; height: 86vh; border: 0; background: #fff; }
  .viewer-body .viewer-fallback {
    color: #fff; padding: 40px; text-align: center;
  }
  .viewer-fallback a { color: #60a5fa; text-decoration: underline; }
</style>
@endpush

@push('scripts')
<script>
  function verPublicacion(el) {
    var archivo = el.dataset.archivo;
    var tipo    = el.dataset.tipo;
    var titulo  = el.dataset.titulo || 'Publicación';

    if (!archivo) { return; }

    document.getElementById('viewerTitulo').textContent = titulo;
    var body = document.getElementById('viewerBody');

    if (tipo === 'pdf') {
      body.innerHTML = '<iframe src="' + archivo + '#view=FitH" title="' + titulo.replace(/"/g, '&quot;') + '"></iframe>';
    } else if (tipo === 'imagen') {
      body.innerHTML = '<img src="' + archivo + '" alt="' + titulo.replace(/"/g, '&quot;') + '">';
    } else {
      body.innerHTML = '<div class="viewer-fallback">No se puede previsualizar este tipo de archivo. <a href="' + archivo + '" target="_blank" rel="noopener">Abrir en nueva pestaña</a></div>';
    }

    document.getElementById('viewerModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function cerrarViewer() {
    document.getElementById('viewerModal').style.display = 'none';
    document.getElementById('viewerBody').innerHTML = '';
    document.body.style.overflow = '';
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && document.getElementById('viewerModal').style.display === 'flex') {
      cerrarViewer();
    }
  });
</script>
@endpush

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

    @php
      $fTipo = request('tipo');
      $fQ = request('q', '');
      $fCategoria = request('categoria');
      $fDesde = request('desde');
      $fHasta = request('hasta');
      $fOrden = request('orden', 'recientes');
      $hayFiltros = $fTipo || $fQ !== '' || $fCategoria || $fDesde || $fHasta || ($fOrden && $fOrden !== 'recientes');
    @endphp

    <form method="GET" action="{{ route('galeria') }}" id="galeriaFiltros">
      <div class="gallery-toolbar">
        <div class="tabs">
          <a class="tab {{ ! $fTipo ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['tipo' => null, 'page' => null]) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            Todas
          </a>
          <a class="tab {{ $fTipo === 'imagen' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['tipo' => 'imagen', 'page' => null]) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="14" rx="2"/><circle cx="9" cy="10" r="2"/><path d="m21 15-5-5-9 9"/></svg>
            Imágenes
          </a>
          <a class="tab {{ $fTipo === 'pdf' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['tipo' => 'pdf', 'page' => null]) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><path d="M14 3v6h6"/></svg>
            PDFs
          </a>
          <a class="tab {{ $fTipo === 'otro' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['tipo' => 'otro', 'page' => null]) }}">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/></svg>
            Otros
          </a>
        </div>

        <div class="gallery-actions">
          <label class="search" style="min-width: 300px;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
            <input type="search" name="q" value="{{ $fQ }}" placeholder="Buscar publicaciones...">
          </label>
          <select name="orden" class="select-input" style="width: auto; min-width: 150px;" onchange="this.form.submit()">
            <option value="recientes" {{ $fOrden === 'recientes' ? 'selected' : '' }}>Más recientes</option>
            <option value="antiguos" {{ $fOrden === 'antiguos' ? 'selected' : '' }}>Más antiguos</option>
            <option value="az" {{ $fOrden === 'az' ? 'selected' : '' }}>A-Z</option>
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
                <input type="radio" name="tipo" value="" {{ ! $fTipo ? 'checked' : '' }} onchange="this.form.submit()">
                Todas
              </label>
              <label class="checkbox-group">
                <input type="radio" name="tipo" value="imagen" {{ $fTipo === 'imagen' ? 'checked' : '' }} onchange="this.form.submit()">
                Imágenes
              </label>
              <label class="checkbox-group">
                <input type="radio" name="tipo" value="pdf" {{ $fTipo === 'pdf' ? 'checked' : '' }} onchange="this.form.submit()">
                PDFs
              </label>
              <label class="checkbox-group">
                <input type="radio" name="tipo" value="otro" {{ $fTipo === 'otro' ? 'checked' : '' }} onchange="this.form.submit()">
                Otros
              </label>
            </div>
          </div>

          <div class="filter-group">
            <h4>Categorías</h4>
            <select name="categoria" class="select-input" onchange="this.form.submit()">
              <option value="">Todas las categorías</option>
              @foreach($categorias as $cat)
                <option value="{{ $cat->id }}" {{ (string) $fCategoria === (string) $cat->id ? 'selected' : '' }}>{{ $cat->nombre }}</option>
              @endforeach
            </select>
          </div>

          <div class="filter-group">
            <h4>Fecha</h4>
            <div class="date-inputs">
              <div class="date-field">
                <label>Desde</label>
                <input type="date" name="desde" value="{{ $fDesde }}" class="select-input" onchange="this.form.submit()">
              </div>
              <div class="date-field">
                <label>Hasta</label>
                <input type="date" name="hasta" value="{{ $fHasta }}" class="select-input" onchange="this.form.submit()">
              </div>
            </div>
          </div>

          @if($hayFiltros)
            <a href="{{ route('galeria') }}" class="btn btn-outline btn-block" style="border-color: var(--line); color: var(--text); text-decoration: none; display: inline-flex; align-items: center; justify-content: center; gap: 6px;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 16px;"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
              Limpiar filtros
            </a>
          @else
            <button type="button" class="btn btn-outline btn-block" disabled style="border-color: var(--line); color: var(--muted); opacity: .55;">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 16px;"><path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/><path d="M3 3v5h5"/></svg>
              Limpiar filtros
            </button>
          @endif
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
    </form>

    {{-- Visor de publicaciones --}}
    <div id="viewerModal" class="viewer-overlay" style="display:none;" onclick="cerrarViewer()">
      <div class="viewer-box" onclick="event.stopPropagation()">
        <div class="viewer-header">
          <h3 id="viewerTitulo">—</h3>
          <button type="button" class="viewer-close" onclick="cerrarViewer()" aria-label="Cerrar">&times;</button>
        </div>
        <div class="viewer-body" id="viewerBody"></div>
      </div>
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
