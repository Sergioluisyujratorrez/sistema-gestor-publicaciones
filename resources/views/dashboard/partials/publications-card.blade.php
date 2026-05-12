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

  @php
    $tipoPubActivo = request('tipo_pub');
    $qPubActivo = request('q_pub', '');
  @endphp

  <form method="GET" class="search-bar" role="search">
    <div class="search-input-wrap">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
      <input type="text" name="q_pub" value="{{ $qPubActivo }}" placeholder="Buscar publicación por título…" class="search-input">
    </div>
    @if($tipoPubActivo)
      <input type="hidden" name="tipo_pub" value="{{ $tipoPubActivo }}">
    @endif
    <button type="submit" class="btn btn-primary">Buscar</button>
    @if($qPubActivo !== '' || $tipoPubActivo)
      <a href="{{ url()->current() }}" class="btn btn-ghost">Limpiar</a>
    @endif
    <a href="{{ route('dashboard.publicaciones.reporte', request()->only(['q_pub', 'tipo_pub'])) }}"
       class="btn btn-report"
       target="_blank"
       title="Descargar reporte PDF">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="width:16px;height:16px;"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><path d="M14 3v6h6"/><path d="M12 13v5M9 16l3 3 3-3"/></svg>
      Reporte
    </a>
  </form>

  <div class="tabs">
    <a class="tab {{ ! $tipoPubActivo ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['tipo_pub' => null, 'pub_page' => null]) }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
      Todas
    </a>
    <a class="tab {{ $tipoPubActivo === 'imagen' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['tipo_pub' => 'imagen', 'pub_page' => null]) }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="14" rx="2"/><circle cx="9" cy="10" r="2"/><path d="m21 15-5-5-9 9"/></svg>
      Imágenes
    </a>
    <a class="tab {{ $tipoPubActivo === 'pdf' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['tipo_pub' => 'pdf', 'pub_page' => null]) }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><path d="M14 3v6h6"/></svg>
      PDFs
    </a>
    <a class="tab {{ $tipoPubActivo === 'otro' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['tipo_pub' => 'otro', 'pub_page' => null]) }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="5" cy="12" r="1.5"/><circle cx="12" cy="12" r="1.5"/><circle cx="19" cy="12" r="1.5"/></svg>
      Otros
    </a>
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
              <form action="{{ route('dashboard.publicaciones.toggle', $publicacion) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ $publicacion->estado ? '¿Desactivar esta publicación? No será visible en la parte pública.' : '¿Activar esta publicación? Volverá a ser visible en la parte pública.' }}');">
                @csrf
                @method('PATCH')
                @if($publicacion->estado)
                  <button type="submit" class="icon-btn ghost" aria-label="Desactivar" title="Desactivar">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/></svg>
                  </button>
                @else
                  <button type="submit" class="icon-btn ghost" aria-label="Activar" title="Activar">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                  </button>
                @endif
              </form>
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
