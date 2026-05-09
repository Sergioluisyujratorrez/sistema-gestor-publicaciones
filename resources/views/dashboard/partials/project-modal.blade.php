<div class="modal-overlay" id="modalNuevoProyecto" style="display:none;">
  <div class="modal" style="max-width:560px;">
    <div class="modal-header">
      <h2>Nuevo proyecto</h2>
      <button class="icon-btn ghost" type="button" onclick="cerrarModalProyecto()" aria-label="Cerrar">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
      </button>
    </div>

    <form action="{{ route('dashboard.proyectos.store') }}" method="POST" enctype="multipart/form-data" class="modal-form">
      @csrf

      @if($errors->any())
        <div class="alert-error" style="margin-bottom: 16px;">
          <ul style="margin:0; padding-left:16px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="form-group">
        <label class="form-label" for="p_titulo">Título <span style="color:var(--red)">*</span></label>
        <input
          type="text"
          id="p_titulo"
          name="titulo"
          class="form-input {{ $errors->has('titulo') ? 'input-error' : '' }}"
          value="{{ old('titulo') }}"
          placeholder="Ej. Dashboard financiero"
          autocomplete="off"
        >
      </div>

      <div class="form-group">
        <label class="form-label" for="p_descripcion">Descripción</label>
        <textarea
          id="p_descripcion"
          name="descripcion"
          class="form-input"
          rows="3"
          placeholder="Descripción opcional del proyecto"
        >{{ old('descripcion') }}</textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="p_tipo">Tipo <span style="color:var(--red)">*</span></label>
          <select id="p_tipo" name="tipo" class="form-input {{ $errors->has('tipo') ? 'input-error' : '' }}">
            <option value="">Seleccionar tipo</option>
            <option value="sitio_web" {{ old('tipo') === 'sitio_web' ? 'selected' : '' }}>Sitio web</option>
            <option value="aplicacion" {{ old('tipo') === 'aplicacion' ? 'selected' : '' }}>Aplicación</option>
            <option value="dashboard" {{ old('tipo') === 'dashboard' ? 'selected' : '' }}>Dashboard</option>
            <option value="tienda_online" {{ old('tipo') === 'tienda_online' ? 'selected' : '' }}>Tienda online</option>
            <option value="otro" {{ old('tipo') === 'otro' ? 'selected' : '' }}>Otro</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="p_categoria_id">Categoría</label>
          <select id="p_categoria_id" name="categoria_id" class="form-input">
            <option value="">Sin categoría</option>
            @foreach($categorias as $categoria)
              <option value="{{ $categoria->id }}" {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                {{ $categoria->nombre }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label" for="p_imagen">Imagen de portada</label>
        <input
          type="file"
          id="p_imagen"
          name="imagen"
          class="form-input {{ $errors->has('imagen') ? 'input-error' : '' }}"
          accept=".jpg,.jpeg,.png,.webp"
        >
        <small>JPG, JPEG, PNG o WEBP. Máx. 1 MB.</small>
      </div>

      <div class="form-group">
        <label class="form-label" for="p_enlace">Enlace del proyecto</label>
        <input
          type="url"
          id="p_enlace"
          name="enlace"
          class="form-input {{ $errors->has('enlace') ? 'input-error' : '' }}"
          value="{{ old('enlace') }}"
          placeholder="https://mi-proyecto.com"
        >
      </div>

      @if($tecnologias->isNotEmpty())
        <div class="form-group">
          <label class="form-label">Tecnologías (opcional)</label>
          <div class="checkbox-grid">
            @foreach($tecnologias as $tecnologia)
              <label class="checkbox-group">
                <input
                  type="checkbox"
                  name="tecnologias[]"
                  value="{{ $tecnologia->id }}"
                  {{ in_array($tecnologia->id, old('tecnologias', [])) ? 'checked' : '' }}
                >
                {{ $tecnologia->nombre }}
              </label>
            @endforeach
          </div>
        </div>
      @endif

      <div class="form-group">
        <label class="checkbox-group" style="gap:10px;">
          <input type="hidden" name="estado" value="0">
          <input
            type="checkbox"
            name="estado"
            value="1"
            {{ old('estado', '1') === '1' ? 'checked' : '' }}
          >
          Publicar inmediatamente (activo)
        </label>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="cerrarModalProyecto()">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar proyecto</button>
      </div>
    </form>
  </div>
</div>
