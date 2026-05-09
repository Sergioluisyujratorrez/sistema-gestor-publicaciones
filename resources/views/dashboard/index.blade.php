@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard')
@section('dashboard-subtitle', 'Gestiona tu contenido y proyectos')

@section('content')
  @include('dashboard.partials.publications-card')
  @include('dashboard.partials.publication-modal')
  @include('dashboard.partials.publication-edit-modal')

  @include('dashboard.partials.projects-card')
  @include('dashboard.partials.project-modal')
  @include('dashboard.partials.project-edit-modal')

  <section class="metrics-row">
    <div class="card metric-card">
      <span class="metric-label">Publicaciones</span>
      <strong class="metric-value">128</strong>
      <small class="metric-trend">+ 12% este mes</small>
      <svg class="sparkline" viewBox="0 0 200 60" preserveAspectRatio="none">
        <defs>
          <linearGradient id="sp1" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0%" stop-color="#3b82f6"/>
            <stop offset="100%" stop-color="#22d3ee"/>
          </linearGradient>
        </defs>
        <polyline fill="none" stroke="url(#sp1)" stroke-width="2.4" points="0,40 20,32 40,38 60,22 80,30 100,18 120,28 140,12 160,22 180,8 200,16"/>
      </svg>
    </div>

    <div class="card metric-card">
      <span class="metric-label">Proyectos</span>
      <strong class="metric-value">24</strong>
      <small class="metric-trend">+ 8% este mes</small>
      <svg class="sparkline" viewBox="0 0 200 60" preserveAspectRatio="none">
        <defs>
          <linearGradient id="sp2" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0%" stop-color="#10b981"/>
            <stop offset="100%" stop-color="#84cc16"/>
          </linearGradient>
        </defs>
        <polyline fill="none" stroke="url(#sp2)" stroke-width="2.4" points="0,42 20,30 40,36 60,20 80,30 100,14 120,22 140,8 160,18 180,4 200,12"/>
      </svg>
    </div>

    <!-- <div class="card metric-card">
      <span class="metric-label">Visualizaciones</span>
      <strong class="metric-value">5.4K</strong>
      <small class="metric-trend">+ 16% este mes</small>
      <svg class="sparkline" viewBox="0 0 200 60" preserveAspectRatio="none">
        <defs>
          <linearGradient id="sp3" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0%" stop-color="#8b5cf6"/>
            <stop offset="100%" stop-color="#ec4899"/>
          </linearGradient>
        </defs>
        <polyline fill="none" stroke="url(#sp3)" stroke-width="2.4" points="0,38 20,28 40,34 60,18 80,26 100,12 120,22 140,8 160,16 180,2 200,10"/>
      </svg>
    </div>

    <div class="card metric-card">
      <span class="metric-label">Descargas</span>
      <strong class="metric-value">1.2K</strong>
      <small class="metric-trend">+ 19% este mes</small>
      <svg class="sparkline" viewBox="0 0 200 60" preserveAspectRatio="none">
        <defs>
          <linearGradient id="sp4" x1="0" y1="0" x2="1" y2="0">
            <stop offset="0%" stop-color="#f97316"/>
            <stop offset="100%" stop-color="#ec4899"/>
          </linearGradient>
        </defs>
        <polyline fill="none" stroke="url(#sp4)" stroke-width="2.4" points="0,40 20,30 40,36 60,18 80,28 100,14 120,22 140,6 160,18 180,2 200,12"/>
      </svg>
    </div> -->

    <div class="card activity-card">
      <strong>Actividad reciente</strong>
      <div class="activity-item">
        <span class="activity-icon blue">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="14" rx="2"/><circle cx="9" cy="10" r="2"/><path d="m21 15-5-5-9 9"/></svg>
        </span>
        <div>
          <p>Nueva publicación</p>
          <small>Montañas nevadas.jpg</small>
        </div>
        <span class="activity-time">Hace 2 horas</span>
      </div>
      <div class="activity-item">
        <span class="activity-icon green">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 7a2 2 0 0 1 2-2h4l2 2h8a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
        </span>
        <div>
          <p>Proyecto actualizado</p>
          <small>Fintech Dashboard</small>
        </div>
        <span class="activity-time">Hace 5 horas</span>
      </div>
      <div class="activity-item">
        <span class="activity-icon violet">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M21 11.5a8.4 8.4 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.4 8.4 0 0 1-3.8-.9L3 21l1.9-5.7A8.4 8.4 0 0 1 4 11.5a8.5 8.5 0 0 1 4.7-7.6 8.4 8.4 0 0 1 3.8-.9h.5a8.5 8.5 0 0 1 8 8z"/></svg>
        </span>
        <div>
          <p>Nuevo comentario</p>
          <small>Dashboard UI Kit</small>
        </div>
        <span class="activity-time">Hace 1 día</span>
      </div>
      <a class="btn btn-ghost btn-block" href="#">Ver toda la actividad</a>
    </div>
  </section>
@endsection

@push('styles')
<style>
  .modal-overlay { position:fixed; inset:0; background:rgba(0,0,0,.65); z-index:1000; display:flex; align-items:center; justify-content:center; padding:16px; }
  .modal { background:var(--panel); border:1px solid var(--line-strong); border-radius:14px; width:100%; max-height:90vh; overflow-y:auto; box-shadow:0 24px 64px rgba(0,0,0,.55); color:var(--text); }
  .modal-header { display:flex; align-items:center; justify-content:space-between; padding:22px 24px 16px; border-bottom:1px solid var(--line); }
  .modal-header h2 { margin:0; font-size:17px; font-weight:800; color:var(--text); }
  .modal-header .icon-btn { width:32px; height:32px; color:var(--muted); }
  .modal-form { padding:20px 24px 24px; }
  .form-group { margin-bottom:16px; }
  .form-label { display:block; font-size:12.5px; font-weight:700; margin-bottom:7px; color:var(--muted); letter-spacing:0.02em; }
  .modal-form input[type="text"],.modal-form input[type="url"],.modal-form input[type="file"],.modal-form textarea,.modal-form select { width:100%; box-sizing:border-box; background:var(--panel-2); border:1px solid var(--line-strong); border-radius:8px; padding:10px 14px; color:var(--text); font-size:14px; font-family:inherit; outline:none; transition:border-color .18s,background .18s; appearance:none; -webkit-appearance:none; }
  .modal-form input[type="text"]:focus,.modal-form input[type="url"]:focus,.modal-form textarea:focus,.modal-form select:focus { border-color:var(--blue); background:#0c1633; }
  .modal-form input[type="file"] { padding:8px 14px; cursor:pointer; }
  .modal-form input[type="file"]::-webkit-file-upload-button { background:var(--blue); color:#fff; border:none; border-radius:6px; padding:5px 14px; font-size:13px; font-weight:700; cursor:pointer; margin-right:10px; }
  .modal-form select option { background:var(--panel-2); color:var(--text); }
  .modal-form textarea { resize:vertical; min-height:80px; }
  .modal-form small { color:var(--muted); font-size:12px; display:block; margin-top:5px; }
  .form-row { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
  .modal-form .checkbox-group { display:flex; align-items:center; gap:8px; font-size:13.5px; color:var(--text); cursor:pointer; }
  .modal-form .checkbox-group input[type="checkbox"] { width:16px; height:16px; accent-color:var(--blue); cursor:pointer; }
  .checkbox-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(140px,1fr)); gap:8px; padding:10px; background:var(--panel-2); border:1px solid var(--line-strong); border-radius:8px; }
  .input-error { border-color:var(--red)!important; }
  .alert-error { background:rgba(239,68,68,.1); border:1px solid rgba(239,68,68,.3); border-radius:8px; padding:12px 16px; font-size:13px; color:#ff7878; margin-bottom:16px; }
  .alert-success { background:rgba(34,197,94,.1); border:1px solid rgba(34,197,94,.25); border-radius:8px; padding:12px 16px; font-size:13px; color:var(--green); margin-bottom:16px; }
  .modal-footer { display:flex; justify-content:flex-end; gap:10px; padding-top:16px; border-top:1px solid var(--line); margin-top:4px; }
  .thumb-real { width:40px; height:40px; border-radius:6px; object-fit:cover; }
  .thumb-pdf-icon { width:40px; height:40px; border-radius:6px; background:rgba(239,68,68,.15); display:flex; align-items:center; justify-content:center; font-size:10px; font-weight:800; color:#ff7878; border:1px solid rgba(239,68,68,.2); }
  .thumb-otro-icon { width:40px; height:40px; border-radius:6px; background:var(--panel-2); display:flex; align-items:center; justify-content:center; color:var(--muted); border:1px solid var(--line-strong); }
  .badge-green { color:var(--green); background:rgba(34,197,94,.15); }
</style>
@endpush

@push('scripts')
<script>
  function abrirModal() { document.getElementById('modalNuevaPublicacion').style.display='flex'; document.body.style.overflow='hidden'; }
  function cerrarModal() { document.getElementById('modalNuevaPublicacion').style.display='none'; document.body.style.overflow=''; }
  document.getElementById('modalNuevaPublicacion').addEventListener('click',function(e){ if(e.target===this) cerrarModal(); });

  function editarPublicacion(btn) {
    var tecnologias = btn.dataset.tecnologias ? btn.dataset.tecnologias.split(',').map(Number) : [];
    var form = document.getElementById('formEditarPublicacion');
    form.action = '/dashboard/publicaciones/' + btn.dataset.id;
    document.getElementById('edit_titulo').value       = btn.dataset.titulo;
    document.getElementById('edit_descripcion').value  = btn.dataset.descripcion;
    document.getElementById('edit_tipo').value         = btn.dataset.tipo;
    document.getElementById('edit_categoria_id').value = btn.dataset.categoria;
    document.getElementById('edit_estado').checked     = btn.dataset.estado === '1';
    var partes = btn.dataset.archivo ? btn.dataset.archivo.split('/') : [];
    document.getElementById('edit_archivo_actual').textContent = partes.length ? partes[partes.length-1] : '—';
    document.getElementById('edit_archivo').value = '';
    document.querySelectorAll('#edit_tecnologias_grid input[type="checkbox"]').forEach(function(cb){ cb.checked = tecnologias.includes(Number(cb.dataset.tecid)); });
    document.getElementById('modalEditarPublicacion').style.display='flex'; document.body.style.overflow='hidden';
  }
  function cerrarModalEditarPublicacion() { document.getElementById('modalEditarPublicacion').style.display='none'; document.body.style.overflow=''; }
  document.getElementById('modalEditarPublicacion').addEventListener('click',function(e){ if(e.target===this) cerrarModalEditarPublicacion(); });

  function abrirModalProyecto() { document.getElementById('modalNuevoProyecto').style.display='flex'; document.body.style.overflow='hidden'; }
  function cerrarModalProyecto() { document.getElementById('modalNuevoProyecto').style.display='none'; document.body.style.overflow=''; }
  document.getElementById('modalNuevoProyecto').addEventListener('click',function(e){ if(e.target===this) cerrarModalProyecto(); });

  function editarProyecto(btn) {
    var tecnologias = btn.dataset.tecnologias ? btn.dataset.tecnologias.split(',').map(Number) : [];
    var form = document.getElementById('formEditarProyecto');
    form.action = '/dashboard/proyectos/' + btn.dataset.id;
    document.getElementById('edit_p_titulo').value       = btn.dataset.titulo;
    document.getElementById('edit_p_descripcion').value  = btn.dataset.descripcion;
    document.getElementById('edit_p_tipo').value         = btn.dataset.tipo;
    document.getElementById('edit_p_categoria_id').value = btn.dataset.categoria;
    document.getElementById('edit_p_enlace').value       = btn.dataset.enlace;
    document.getElementById('edit_p_estado').checked     = btn.dataset.estado === '1';
    var partes = btn.dataset.imagen ? btn.dataset.imagen.split('/') : [];
    document.getElementById('edit_imagen_actual').textContent = partes.length && btn.dataset.imagen ? partes[partes.length-1] : 'Sin imagen';
    document.getElementById('edit_p_imagen').value = '';
    document.querySelectorAll('#edit_proy_tecnologias_grid input[type="checkbox"]').forEach(function(cb){ cb.checked = tecnologias.includes(Number(cb.dataset.tecid)); });
    document.getElementById('modalEditarProyecto').style.display='flex'; document.body.style.overflow='hidden';
  }
  function cerrarModalEditarProyecto() { document.getElementById('modalEditarProyecto').style.display='none'; document.body.style.overflow=''; }
  document.getElementById('modalEditarProyecto').addEventListener('click',function(e){ if(e.target===this) cerrarModalEditarProyecto(); });
</script>
@endpush
