<div id="modalNuevaCategoria" class="modal-overlay" style="display:none;">
  <div class="modal" style="max-width: 560px;">
    <div class="modal-header">
      <h2>Nueva categoría</h2>
      <button type="button" class="icon-btn" onclick="cerrarModalCategoria()" aria-label="Cerrar">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="18" height="18"><path d="M18 6 6 18M6 6l12 12"/></svg>
      </button>
    </div>

    <form action="{{ route('dashboard.categorias.store') }}" method="POST" class="modal-form">
      @csrf

      @if($errors->any() && ! session('edit_categoria_id'))
        <div class="alert-error">
          @foreach($errors->all() as $error)<div>{{ $error }}</div>@endforeach
        </div>
      @endif

      <div class="form-group">
        <label class="form-label" for="cat_nombre">Nombre <span style="color:var(--red);">*</span></label>
        <input type="text" id="cat_nombre" name="nombre" value="{{ old('nombre') }}" placeholder="Ej. Diseño Gráfico" class="{{ $errors->has('nombre') ? 'input-error' : '' }}">
      </div>

      <div class="form-group">
        <label class="form-label" for="cat_descripcion">Descripción</label>
        <textarea id="cat_descripcion" name="descripcion" placeholder="Descripción opcional de la categoría">{{ old('descripcion') }}</textarea>
      </div>

      <div class="form-group">
        <label class="form-label" for="cat_tipo">Tipo <span style="color:var(--red);">*</span></label>
        <select id="cat_tipo" name="tipo" class="{{ $errors->has('tipo') ? 'input-error' : '' }}">
          <option value="">Seleccionar tipo</option>
          <option value="publicacion" {{ old('tipo') === 'publicacion' ? 'selected' : '' }}>Publicación</option>
          <option value="proyecto" {{ old('tipo') === 'proyecto' ? 'selected' : '' }}>Proyecto</option>
          <option value="ambos" {{ old('tipo') === 'ambos' ? 'selected' : '' }}>Ambos</option>
        </select>
      </div>

      <div class="form-group">
        <label class="checkbox-group">
          <input type="checkbox" name="estado" value="1" {{ old('estado', '1') ? 'checked' : '' }}>
          Activar inmediatamente
        </label>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-outline" onclick="cerrarModalCategoria()">Cancelar</button>
        <button type="submit" class="btn btn-primary">Guardar categoría</button>
      </div>
    </form>
  </div>
</div>
