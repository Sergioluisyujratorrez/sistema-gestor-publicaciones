<section class="card section-card" id="publicaciones">
  <div class="card-head">
    <div>
      <h2>Publicaciones</h2>
      <p>Administra las publicaciones de tu galería.</p>
    </div>
    <button class="btn btn-primary" type="button" onclick="abrirModal()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
      Nueva publicación
    </button>
  </div>

  @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

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

  <div class="table-wrap">
    <table class="data-table">
      <thead>
        <tr>
          <th>Vista previa</th>
          <th>Título</th>
          <th>Tipo</th>
          <th>Estado</th>
          <th>Fecha</th>
          <th class="th-actions">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($publicaciones as $publicacion)
          <tr>
            <td>
              @if($publicacion->tipo === 'imagen')
                <img src="{{ asset('storage/' . $publicacion->archivo) }}" alt="{{ $publicacion->titulo }}" class="thumb-real">
              @elseif($publicacion->tipo === 'pdf')
                <div class="thumb-pdf-icon">PDF</div>
              @else
                <div class="thumb-otro-icon">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" width="18" height="18"><circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/></svg>
                </div>
              @endif
            </td>
            <td>
              <strong>{{ $publicacion->titulo }}</strong>
              @if($publicacion->categoria)
                <small>{{ $publicacion->categoria->nombre }}</small>
              @endif
            </td>
            <td>
              @if($publicacion->tipo === 'imagen')
                <span class="badge badge-blue">Imagen</span>
              @elseif($publicacion->tipo === 'pdf')
                <span class="badge badge-red">PDF</span>
              @else
                <span class="badge">Otro</span>
              @endif
            </td>
            <td>
              @if($publicacion->estado)
                <span class="badge badge-green">Activo</span>
              @else
                <span class="badge">Inactivo</span>
              @endif
            </td>
            <td>
              <span class="date">
                {{ $publicacion->created_at->format('d M Y') }}
                <small>{{ $publicacion->created_at->format('h:i A') }}</small>
              </span>
            </td>
            <td class="td-actions">
              <button
                class="icon-btn ghost"
                aria-label="Editar"
                onclick="editarPublicacion(this)"
                data-id="{{ $publicacion->id }}"
                data-titulo="{{ $publicacion->titulo }}"
                data-descripcion="{{ $publicacion->descripcion ?? '' }}"
                data-tipo="{{ $publicacion->tipo }}"
                data-categoria="{{ $publicacion->categoria_id ?? '' }}"
                data-estado="{{ $publicacion->estado ? '1' : '0' }}"
                data-archivo="{{ $publicacion->archivo }}"
                data-tecnologias="{{ $publicacion->tecnologias->pluck('id')->join(',') }}"
              >
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>
              </button>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="5" style="text-align:center; padding: 40px; color: var(--muted);">
              No hay publicaciones todavía. ¡Crea la primera!
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    @if($publicaciones->hasPages())
      <div class="pagination">
        <span class="pag-summary">
          Mostrando {{ $publicaciones->firstItem() }}–{{ $publicaciones->lastItem() }} de {{ $publicaciones->total() }} publicaciones
        </span>
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
  </div>
</section>
