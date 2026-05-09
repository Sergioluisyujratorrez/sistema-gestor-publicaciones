@extends('layouts.dashboard')

@section('title', 'Publisys - Proyectos')
@section('dashboard-title', 'Proyectos')
@section('dashboard-subtitle', 'Administra tus proyectos y enlaces')

@section('content')
  @include('dashboard.partials.projects-card')
  @include('dashboard.partials.project-modal')
  @include('dashboard.partials.project-edit-modal')
@endsection

@push('styles')
<style>
  .modal-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, .65);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
  }

  .modal {
    background: var(--panel);
    border: 1px solid var(--line-strong);
    border-radius: 14px;
    width: 100%;
    max-height: 90vh;
    overflow-y: auto;
    box-shadow: 0 24px 64px rgba(0, 0, 0, .55);
    color: var(--text);
  }

  .modal-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 22px 24px 16px;
    border-bottom: 1px solid var(--line);
  }

  .modal-header h2 {
    margin: 0;
    font-size: 17px;
    font-weight: 800;
    color: var(--text);
  }

  .modal-header .icon-btn {
    width: 32px;
    height: 32px;
    color: var(--muted);
  }

  .modal-form { padding: 20px 24px 24px; }

  .form-group { margin-bottom: 16px; }

  .form-label {
    display: block;
    font-size: 12.5px;
    font-weight: 700;
    margin-bottom: 7px;
    color: var(--muted);
    letter-spacing: 0.02em;
  }

  .modal-form input[type="text"],
  .modal-form input[type="url"],
  .modal-form input[type="file"],
  .modal-form textarea,
  .modal-form select {
    width: 100%;
    box-sizing: border-box;
    background: var(--panel-2);
    border: 1px solid var(--line-strong);
    border-radius: 8px;
    padding: 10px 14px;
    color: var(--text);
    font-size: 14px;
    font-family: inherit;
    outline: none;
    transition: border-color 0.18s ease, background 0.18s ease;
    appearance: none;
    -webkit-appearance: none;
  }

  .modal-form input[type="text"]:focus,
  .modal-form input[type="url"]:focus,
  .modal-form textarea:focus,
  .modal-form select:focus {
    border-color: var(--blue);
    background: #0c1633;
  }

  .modal-form input[type="file"] {
    padding: 8px 14px;
    cursor: pointer;
  }

  .modal-form input[type="file"]::-webkit-file-upload-button {
    background: var(--blue);
    color: #fff;
    border: none;
    border-radius: 6px;
    padding: 5px 14px;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
    margin-right: 10px;
  }

  .modal-form select option {
    background: var(--panel-2);
    color: var(--text);
  }

  .modal-form textarea { resize: vertical; min-height: 80px; }

  .modal-form small { color: var(--muted); font-size: 12px; display: block; margin-top: 5px; }

  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

  .modal-form .checkbox-group {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    color: var(--text);
    cursor: pointer;
  }

  .modal-form .checkbox-group input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: var(--blue);
    cursor: pointer;
  }

  .checkbox-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 8px;
    padding: 10px;
    background: var(--panel-2);
    border: 1px solid var(--line-strong);
    border-radius: 8px;
  }

  .input-error { border-color: var(--red) !important; }

  .alert-error {
    background: rgba(239, 68, 68, .1);
    border: 1px solid rgba(239, 68, 68, .3);
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 13px;
    color: #ff7878;
    margin-bottom: 16px;
  }

  .alert-success {
    background: rgba(34, 197, 94, .1);
    border: 1px solid rgba(34, 197, 94, .25);
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 13px;
    color: var(--green);
  }

  .modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding-top: 16px;
    border-top: 1px solid var(--line);
    margin-top: 4px;
  }

  .thumb-real {
    width: 40px;
    height: 40px;
    border-radius: 6px;
    object-fit: cover;
  }
</style>
@endpush

@push('scripts')
<script>
  /* ---- Modal crear ---- */
  function abrirModalProyecto() {
    document.getElementById('modalNuevoProyecto').style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }
  function cerrarModalProyecto() {
    document.getElementById('modalNuevoProyecto').style.display = 'none';
    document.body.style.overflow = '';
  }
  document.getElementById('modalNuevoProyecto').addEventListener('click', function(e) {
    if (e.target === this) { cerrarModalProyecto(); }
  });
  @if($errors->any() && !session('edit_proyecto_id'))
    document.addEventListener('DOMContentLoaded', function() { abrirModalProyecto(); });
  @endif

  /* ---- Modal editar ---- */
  function editarProyecto(btn) {
    var id          = btn.dataset.id;
    var titulo      = btn.dataset.titulo;
    var descripcion = btn.dataset.descripcion;
    var tipo        = btn.dataset.tipo;
    var categoria   = btn.dataset.categoria;
    var enlace      = btn.dataset.enlace;
    var estado      = btn.dataset.estado;
    var imagen      = btn.dataset.imagen;
    var tecnologias = btn.dataset.tecnologias ? btn.dataset.tecnologias.split(',').map(Number) : [];

    var form = document.getElementById('formEditarProyecto');
    form.action = '/dashboard/proyectos/' + id;

    document.getElementById('edit_p_titulo').value       = titulo;
    document.getElementById('edit_p_descripcion').value  = descripcion;
    document.getElementById('edit_p_tipo').value         = tipo;
    document.getElementById('edit_p_categoria_id').value = categoria;
    document.getElementById('edit_p_enlace').value       = enlace;
    document.getElementById('edit_p_estado').checked     = estado === '1';

    /* Mostrar nombre de imagen actual */
    var partes = imagen ? imagen.split('/') : [];
    document.getElementById('edit_imagen_actual').textContent = partes.length && imagen ? partes[partes.length - 1] : 'Sin imagen';

    /* Limpiar input de imagen */
    document.getElementById('edit_p_imagen').value = '';

    /* Tecnologías */
    document.querySelectorAll('#edit_proy_tecnologias_grid input[type="checkbox"]').forEach(function(cb) {
      cb.checked = tecnologias.includes(Number(cb.dataset.tecid));
    });

    document.getElementById('modalEditarProyecto').style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function cerrarModalEditarProyecto() {
    document.getElementById('modalEditarProyecto').style.display = 'none';
    document.body.style.overflow = '';
  }

  document.getElementById('modalEditarProyecto').addEventListener('click', function(e) {
    if (e.target === this) { cerrarModalEditarProyecto(); }
  });

  @if($errors->any() && session('edit_proyecto_id'))
    document.addEventListener('DOMContentLoaded', function() {
      var btn = document.querySelector('[data-id="{{ session('edit_proyecto_id') }}"]');
      if (btn) { editarProyecto(btn); }
    });
  @endif
</script>
@endpush
