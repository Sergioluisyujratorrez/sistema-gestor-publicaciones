@extends('layouts.dashboard')

@section('title', 'Publisys - Categorías')
@section('dashboard-title', 'Categorías')
@section('dashboard-subtitle', 'Administra las categorías de publicaciones y proyectos')

@section('content')
  @include('dashboard.partials.categories-card')
  @include('dashboard.partials.category-modal')
  @include('dashboard.partials.category-edit-modal')
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

  .modal-header .icon-btn { width: 32px; height: 32px; color: var(--muted); }

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
  .modal-form textarea:focus,
  .modal-form select:focus {
    border-color: var(--blue);
    background: #0c1633;
  }

  .modal-form select option { background: var(--panel-2); color: var(--text); }
  .modal-form textarea { resize: vertical; min-height: 80px; }

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
    margin-bottom: 16px;
  }

  .modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    padding-top: 16px;
    border-top: 1px solid var(--line);
    margin-top: 4px;
  }

  .badge-green { color: var(--green); background: rgba(34, 197, 94, .15); }
</style>
@endpush

@push('scripts')
<script>
  function abrirModalCategoria() {
    document.getElementById('modalNuevaCategoria').style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }
  function cerrarModalCategoria() {
    document.getElementById('modalNuevaCategoria').style.display = 'none';
    document.body.style.overflow = '';
  }
  document.getElementById('modalNuevaCategoria').addEventListener('click', function(e) {
    if (e.target === this) { cerrarModalCategoria(); }
  });
  @if($errors->any() && ! session('edit_categoria_id'))
    document.addEventListener('DOMContentLoaded', function() { abrirModalCategoria(); });
  @endif

  function editarCategoria(btn) {
    var id          = btn.dataset.id;
    var nombre      = btn.dataset.nombre;
    var descripcion = btn.dataset.descripcion;
    var tipo        = btn.dataset.tipo;
    var estado      = btn.dataset.estado;

    var form = document.getElementById('formEditarCategoria');
    form.action = '/dashboard/categorias/' + id;

    document.getElementById('edit_cat_nombre').value      = nombre;
    document.getElementById('edit_cat_descripcion').value = descripcion;
    document.getElementById('edit_cat_tipo').value        = tipo;
    document.getElementById('edit_cat_estado').checked    = estado === '1';

    document.getElementById('modalEditarCategoria').style.display = 'flex';
    document.body.style.overflow = 'hidden';
  }

  function cerrarModalEditarCategoria() {
    document.getElementById('modalEditarCategoria').style.display = 'none';
    document.body.style.overflow = '';
  }

  document.getElementById('modalEditarCategoria').addEventListener('click', function(e) {
    if (e.target === this) { cerrarModalEditarCategoria(); }
  });

  @if($errors->any() && session('edit_categoria_id'))
    document.addEventListener('DOMContentLoaded', function() {
      var btn = document.querySelector('[data-id="{{ session('edit_categoria_id') }}"]');
      if (btn) { editarCategoria(btn); }
    });
  @endif
</script>
@endpush
