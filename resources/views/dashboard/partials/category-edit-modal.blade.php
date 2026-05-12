<div id="modalEditarCategoria" class="modal-overlay" style="display:none;">
  <div class="modal" style="max-width: 560px;">
    <div class="modal-header">
      <h2>Editar categoría</h2>
      <button type="button" class="icon-btn" onclick="cerrarModalEditarCategoria()" aria-label="Cerrar">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M18 6 6 18M6 6l12 12"/></svg>
      </button>
    </div>

    <form id="formEditarCategoria" action="" method="POST" class="modal-form">
      @csrf
      @method('PUT')

      @if($errors->any() && session('edit_categoria_id'))
        <div class="alert-error">
          @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
      @endif

      <div class="form-group">
        <label class="form-label" for="edit_cat_nombre">Nombre <span style="color:var(--red);">*</span></label>
        <input type="text" id="edit_cat_nombre" name="nombre" placeholder="Ej. Diseño Gráfico">
      </div>

      <div class="form-group">
        <label class="form-label" for="edit_cat_descripcion">Descripción</label>
        <textarea id="edit_cat_descripcion" name="descripcion" placeholder="Descripción opcional"></textarea>
      </div>

      <div class="form-group">
        <label class="form-label" for="edit_cat_tipo">Tipo <span style="color:var(--red);">*</span></label>
        <select id="edit_cat_tipo" name="tipo">
          <option value="">Seleccionar tipo</option>
          <option value="publicacion">Publicación</option>
          <option value="proyecto">Proyecto</option>
          <option value="ambos">Ambos</option>
        </select>
      </div>

      <div class="form-group">
        <label class="checkbox-group">
          <input type="checkbox" id="edit_cat_estado" name="estado" value="1">
          Activar inmediatamente
        </label>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-outline" onclick="cerrarModalEditarCategoria()">Cancelar</button>
        <button type="submit" class="btn btn-primary">Actualizar categoría</button>
      </div>
    </form>
  </div>
</div>
