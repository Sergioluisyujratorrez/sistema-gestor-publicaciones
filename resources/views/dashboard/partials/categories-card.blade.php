<section class="card section-card" id="categorias">
  <div class="card-head">
    <div>
      <h2>Categorías</h2>
      <p>Administra las categorías para publicaciones y proyectos.</p>
    </div>
    <button class="btn btn-primary" type="button" onclick="abrirModalCategoria()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
      Nueva categoría
    </button>
  </div>

  @if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
  @endif

  @php
    $tipoCatActivo = request('tipo_cat');
    $qCatActivo = request('q_cat', '');
  @endphp

  <form method="GET" class="search-bar" role="search">
    <div class="search-input-wrap">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
      <input type="text" name="q_cat" value="{{ $qCatActivo }}" placeholder="Buscar categoría por nombre…" class="search-input">
    </div>
    @if($tipoCatActivo)
      <input type="hidden" name="tipo_cat" value="{{ $tipoCatActivo }}">
    @endif
    <button type="submit" class="btn btn-primary">Buscar</button>
    @if($qCatActivo !== '' || $tipoCatActivo)
      <a href="{{ url()->current() }}" class="btn btn-ghost">Limpiar</a>
    @endif
  </form>

  <div class="tabs">
    <a class="tab {{ ! $tipoCatActivo ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['tipo_cat' => null, 'page' => null]) }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
      Todas
    </a>
    <a class="tab {{ $tipoCatActivo === 'publicacion' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['tipo_cat' => 'publicacion', 'page' => null]) }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="14" rx="2"/><circle cx="9" cy="10" r="2"/></svg>
      Publicaciones
    </a>
    <a class="tab {{ $tipoCatActivo === 'proyecto' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['tipo_cat' => 'proyecto', 'page' => null]) }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
      Proyectos
    </a>
    <a class="tab {{ $tipoCatActivo === 'ambos' ? 'active' : '' }}" href="{{ request()->fullUrlWithQuery(['tipo_cat' => 'ambos', 'page' => null]) }}">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M8 3v4M16 3v4M4 11h16M5 5h14a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7a2 2 0 0 1 2-2z"/></svg>
      Ambos
    </a>
  </div>

  <div class="table-wrap">
    <table class="data-table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Tipo</th>
          <th>Descripción</th>
          <th>Estado</th>
          <th>Fecha</th>
          <th class="th-actions">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($categorias as $categoria)
          <tr>
            <td>
              <strong>{{ $categoria->nombre }}</strong>
              <small>{{ $categoria->slug }}</small>
            </td>
            <td>
              @if($categoria->tipo === 'publicacion')
                <span class="badge badge-blue">Publicación</span>
              @elseif($categoria->tipo === 'proyecto')
                <span class="badge badge-red">Proyecto</span>
              @else
                <span class="badge">Ambos</span>
              @endif
            </td>
            <td>
              @if($categoria->descripcion)
                <span style="color:var(--muted); font-size:13px;">{{ Str::limit($categoria->descripcion, 60) }}</span>
              @else
                <span style="color:var(--muted);">—</span>
              @endif
            </td>
            <td>
              @if($categoria->estado)
                <span class="badge badge-green">Activo</span>
              @else
                <span class="badge">Inactivo</span>
              @endif
            </td>
            <td>
              <span class="date">
                {{ $categoria->created_at->format('d M Y') }}
                <small>{{ $categoria->created_at->format('h:i A') }}</small>
              </span>
            </td>
            <td class="td-actions">
              <button
                class="icon-btn ghost"
                aria-label="Editar"
                onclick="editarCategoria(this)"
                data-id="{{ $categoria->id }}"
                data-nombre="{{ $categoria->nombre }}"
                data-descripcion="{{ $categoria->descripcion ?? '' }}"
                data-tipo="{{ $categoria->tipo }}"
                data-estado="{{ $categoria->estado ? '1' : '0' }}"
              >
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>
              </button>
              <form action="{{ route('dashboard.categorias.toggle', $categoria) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ $categoria->estado ? '¿Desactivar esta categoría?' : '¿Activar esta categoría?' }}');">
                @csrf
                @method('PATCH')
                @if($categoria->estado)
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
            <td colspan="6" style="text-align:center; padding: 40px; color: var(--muted);">
              No hay categorías todavía. ¡Crea la primera!
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>

    @if($categorias->hasPages())
      <div class="pagination">
        <span class="pag-summary">
          Mostrando {{ $categorias->firstItem() }}–{{ $categorias->lastItem() }} de {{ $categorias->total() }} categorías
        </span>
        <div class="pag-controls">
          @if($categorias->onFirstPage())
            <button class="page-btn" disabled aria-label="Anterior"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg></button>
          @else
            <a class="page-btn" href="{{ $categorias->previousPageUrl() }}" aria-label="Anterior"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 6-6 6 6 6"/></svg></a>
          @endif

          @foreach($categorias->getUrlRange(1, $categorias->lastPage()) as $page => $url)
            <a class="page-btn {{ $page === $categorias->currentPage() ? 'active' : '' }}" href="{{ $url }}">{{ $page }}</a>
          @endforeach

          @if($categorias->hasMorePages())
            <a class="page-btn" href="{{ $categorias->nextPageUrl() }}" aria-label="Siguiente"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg></a>
          @else
            <button class="page-btn" disabled aria-label="Siguiente"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 6 6 6-6 6"/></svg></button>
          @endif
        </div>
      </div>
    @endif
  </div>
</section>
