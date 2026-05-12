<section class="card section-card" id="proyectos">
  <div class="card-head">
    <div>
      <h2>Proyectos</h2>
      <p>Administra tus proyectos y enlaces.</p>
    </div>
    <button class="btn btn-primary" type="button" onclick="abrirModalProyecto()">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round"><path d="M12 5v14M5 12h14"/></svg>
      Nuevo proyecto
    </button>
  </div>

  <div class="card-grid">
    <div class="uploader">
      <div class="uploader-icon dual">
        <span class="link-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7 0l3-3a5 5 0 0 0-7-7l-1 1"/><path d="M14 11a5 5 0 0 0-7 0l-3 3a5 5 0 0 0 7 7l1-1"/></svg>
        </span>
        <span class="plus">+</span>
        <span class="image-icon">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="14" rx="2"/><circle cx="9" cy="10" r="2"/><path d="m21 15-5-5-9 9"/></svg>
        </span>
      </div>
      <h3>Crear nuevo proyecto</h3>
      <p>Sube una imagen de portada<br>y agrega el enlace de tu proyecto</p>
      <button class="btn btn-primary btn-block" type="button" onclick="abrirModalProyecto()">Seleccionar imagen</button>
      <input type="text" class="text-input" placeholder="Título del proyecto" onclick="abrirModalProyecto()" readonly style="cursor:pointer;">
      <input type="url" class="text-input" placeholder="https://enlace-del-proyecto.com" onclick="abrirModalProyecto()" readonly style="cursor:pointer;">
      <button class="btn btn-primary btn-block" type="button" onclick="abrirModalProyecto()">Crear proyecto</button>
    </div>

    <div class="table-wrap">
      @php
        $tipoProyActivo = request('tipo_proy');
        $qProyActivo = request('q_proy', '');
      @endphp

      <form method="GET" class="search-bar" role="search">
        <div class="search-input-wrap">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
          <input type="text" name="q_proy" value="{{ $qProyActivo }}" placeholder="Buscar proyecto por título…" class="search-input">
        </div>
        <select name="tipo_proy" class="search-select">
          <option value="">Todos los tipos</option>
          <option value="sitio_web" {{ $tipoProyActivo === 'sitio_web' ? 'selected' : '' }}>Sitio web</option>
          <option value="aplicacion" {{ $tipoProyActivo === 'aplicacion' ? 'selected' : '' }}>Aplicación</option>
          <option value="dashboard" {{ $tipoProyActivo === 'dashboard' ? 'selected' : '' }}>Dashboard</option>
          <option value="tienda_online" {{ $tipoProyActivo === 'tienda_online' ? 'selected' : '' }}>Tienda online</option>
          <option value="otro" {{ $tipoProyActivo === 'otro' ? 'selected' : '' }}>Otro</option>
        </select>
        <button type="submit" class="btn btn-primary">Buscar</button>
        @if($qProyActivo !== '' || $tipoProyActivo)
          <a href="{{ url()->current() }}" class="btn btn-ghost">Limpiar</a>
        @endif
      </form>

      <table class="data-table">
        <thead>
          <tr>
            <th>Vista previa</th>
            <th>Proyecto</th>
            <th>Enlace</th>
            <th>Fecha</th>
            <th class="th-actions">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @forelse($proyectos as $proyecto)
            <tr>
              <td>
                @if($proyecto->imagen)
                  <img src="{{ asset('storage/' . $proyecto->imagen) }}" alt="{{ $proyecto->titulo }}" class="thumb-real">
                @else
                  <span class="thumb thumb-portfolio" style="width:40px;height:40px;border-radius:6px;display:inline-block;"></span>
                @endif
              </td>
              <td>
                <strong>{{ $proyecto->titulo }}</strong>
                @if($proyecto->categoria)
                  <small>{{ $proyecto->categoria->nombre }}</small>
                @else
                  <small>{{ str_replace('_', ' ', ucfirst($proyecto->tipo)) }}</small>
                @endif
              </td>
              <td>
                @if($proyecto->enlace)
                  <a class="ext-link" href="{{ $proyecto->enlace }}" target="_blank" rel="noopener">
                    {{ parse_url($proyecto->enlace, PHP_URL_HOST) ?? $proyecto->enlace }}
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 4h6v6"/><path d="M20 4 10 14"/><path d="M20 14v6H4V4h6"/></svg>
                  </a>
                @else
                  <span style="color:var(--muted);">—</span>
                @endif
              </td>
              <td>
                <span class="date">
                  {{ $proyecto->created_at->format('d M Y') }}
                  <small>{{ $proyecto->created_at->format('h:i A') }}</small>
                </span>
              </td>
              <td class="td-actions">
                <button
                  class="icon-btn ghost"
                  aria-label="Editar"
                  onclick="editarProyecto(this)"
                  data-id="{{ $proyecto->id }}"
                  data-titulo="{{ $proyecto->titulo }}"
                  data-descripcion="{{ $proyecto->descripcion ?? '' }}"
                  data-tipo="{{ $proyecto->tipo }}"
                  data-categoria="{{ $proyecto->categoria_id ?? '' }}"
                  data-enlace="{{ $proyecto->enlace ?? '' }}"
                  data-estado="{{ $proyecto->estado ? '1' : '0' }}"
                  data-imagen="{{ $proyecto->imagen ?? '' }}"
                  data-tecnologias="{{ $proyecto->tecnologias->pluck('id')->join(',') }}"
                >
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20h9"/><path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L7 19l-4 1 1-4z"/></svg>
                </button>
                <form action="{{ route('dashboard.proyectos.toggle', $proyecto) }}" method="POST" style="display:inline;" onsubmit="return confirm('{{ $proyecto->estado ? '¿Desactivar este proyecto? No será visible en la parte pública.' : '¿Activar este proyecto? Volverá a ser visible en la parte pública.' }}');">
                  @csrf
                  @method('PATCH')
                  @if($proyecto->estado)
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
                No hay proyectos todavía. ¡Crea el primero!
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>

      @if(session('success'))
        <div class="alert-success" style="margin: 12px 0 0;">{{ session('success') }}</div>
      @endif

      @if($proyectos->hasPages())
        <div class="pagination">
          <span class="pag-summary">
            Mostrando {{ $proyectos->firstItem() }}–{{ $proyectos->lastItem() }} de {{ $proyectos->total() }} proyectos
          </span>
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
    </div>
  </div>
</section>
