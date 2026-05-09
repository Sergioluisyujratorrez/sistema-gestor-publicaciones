<div class="modal-overlay" id="modalNuevaPublicacion" style="display:none;">
  <div class="modal" style="max-width:560px;">
    <div class="modal-header">
      <h2>Nueva publicación</h2>
      <button class="icon-btn ghost" type="button" onclick="cerrarModal()" aria-label="Cerrar">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
      </button>
    </div>

    <form action="{{ route('dashboard.publicaciones.store') }}" method="POST" enctype="multipart/form-data" class="modal-form" id="formNuevaPublicacion">
      @csrf

      @if($errors->any())
        <div class="alert alert-error" style="margin-bottom: 16px;">
          <ul style="margin:0; padding-left:16px;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="form-group">
        <label class="form-label" for="titulo">Título <span style="color:var(--red)">*</span></label>
        <input
          type="text"
          id="titulo"
          name="titulo"
          class="form-input {{ $errors->has('titulo') ? 'input-error' : '' }}"
          value="{{ old('titulo') }}"
          placeholder="Ej. Fotografía de paisaje urbano"
          autocomplete="off"
        >
      </div>

      <div class="form-group">
        <label class="form-label" for="descripcion">Descripción</label>
        <textarea
          id="descripcion"
          name="descripcion"
          class="form-input"
          rows="3"
          placeholder="Descripción opcional de la publicación"
        >{{ old('descripcion') }}</textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="tipo">Tipo <span style="color:var(--red)">*</span></label>
          <select id="tipo" name="tipo" class="form-input select-input {{ $errors->has('tipo') ? 'input-error' : '' }}">
            <option value="">Seleccionar tipo</option>
            <option value="imagen" {{ old('tipo') === 'imagen' ? 'selected' : '' }}>Imagen</option>
            <option value="pdf" {{ old('tipo') === 'pdf' ? 'selected' : '' }}>PDF</option>
            <option value="otro" {{ old('tipo') === 'otro' ? 'selected' : '' }}>Otro</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="categoria_id">Categoría</label>
          <select id="categoria_id" name="categoria_id" class="form-input select-input">
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
        <label class="form-label" for="archivo">Archivo <span style="color:var(--red)">*</span></label>
        <input
          type="file"
          id="archivo"
          name="archivo"
          class="form-input {{ $errors->has('archivo') ? 'input-error' : '' }}"
          accept=".jpg,.jpeg,.png,.webp,.pdf"
        >
        <small style="color:var(--muted); margin-top:4px; display:block;">JPG, JPEG, PNG, WEBP o PDF. Máx. 1 MB.</small>
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
        <button type="button" class="btn btn-ghost" onclick="cerrarModal()">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar publicación</button>
      </div>
    </form>
  </div>
</div>
