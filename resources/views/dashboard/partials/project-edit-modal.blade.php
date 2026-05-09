<div class="modal-overlay" id="modalEditarProyecto" style="display:none;">
  <div class="modal" style="max-width:560px;">
    <div class="modal-header">
      <h2>Editar proyecto</h2>
      <button class="icon-btn ghost" type="button" onclick="cerrarModalEditarProyecto()" aria-label="Cerrar">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18M6 6l12 12"/></svg>
      </button>
    </div>

    <form id="formEditarProyecto" method="POST" enctype="multipart/form-data" class="modal-form">
      @csrf
      @method('PUT')

      <div id="edit-proy-errors" style="display:none;" class="alert-error" style="margin-bottom:16px;"></div>

      <div class="form-group">
        <label class="form-label" for="edit_p_titulo">Título <span style="color:var(--red)">*</span></label>
        <input type="text" id="edit_p_titulo" name="titulo" class="form-input" placeholder="Título del proyecto" autocomplete="off">
      </div>

      <div class="form-group">
        <label class="form-label" for="edit_p_descripcion">Descripción</label>
        <textarea id="edit_p_descripcion" name="descripcion" class="form-input" rows="3" placeholder="Descripción opcional"></textarea>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label class="form-label" for="edit_p_tipo">Tipo <span style="color:var(--red)">*</span></label>
          <select id="edit_p_tipo" name="tipo" class="form-input">
            <option value="">Seleccionar tipo</option>
            <option value="sitio_web">Sitio web</option>
            <option value="aplicacion">Aplicación</option>
            <option value="dashboard">Dashboard</option>
            <option value="tienda_online">Tienda online</option>
            <option value="otro">Otro</option>
          </select>
        </div>

        <div class="form-group">
          <label class="form-label" for="edit_p_categoria_id">Categoría</label>
          <select id="edit_p_categoria_id" name="categoria_id" class="form-input">
            <option value="">Sin categoría</option>
            @foreach($categorias as $categoria)
              <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group">
        <label class="form-label" for="edit_p_enlace">Enlace del proyecto</label>
        <input type="url" id="edit_p_enlace" name="enlace" class="form-input" placeholder="https://mi-proyecto.com">
      </div>

      <div class="form-group">
        <label class="form-label">Imagen actual</label>
        <div id="edit_imagen_actual" style="font-size:13px; color:var(--muted); padding:8px 0;"></div>
        <label class="form-label" for="edit_p_imagen" style="margin-top:8px;">Cambiar imagen <span style="color:var(--muted); font-weight:400;">(opcional)</span></label>
        <input type="file" id="edit_p_imagen" name="imagen" class="form-input" accept=".jpg,.jpeg,.png,.webp">
        <small>JPG, JPEG, PNG o WEBP. Máx. 1 MB. Dejar vacío para mantener la actual.</small>
      </div>

      @if($tecnologias->isNotEmpty())
        <div class="form-group">
          <label class="form-label">Tecnologías (opcional)</label>
          <div class="checkbox-grid" id="edit_proy_tecnologias_grid">
            @foreach($tecnologias as $tecnologia)
              <label class="checkbox-group">
                <input type="checkbox" name="tecnologias[]" value="{{ $tecnologia->id }}" data-tecid="{{ $tecnologia->id }}">
                {{ $tecnologia->nombre }}
              </label>
            @endforeach
          </div>
        </div>
      @endif

      <div class="form-group">
        <label class="checkbox-group" style="gap:10px;">
          <input type="hidden" name="estado" value="0">
          <input type="checkbox" id="edit_p_estado" name="estado" value="1">
          Publicar (activo)
        </label>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-ghost" onclick="cerrarModalEditarProyecto()">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar cambios</button>
      </div>
    </form>
  </div>
</div>
