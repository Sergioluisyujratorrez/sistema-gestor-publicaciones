@extends('layouts.dashboard')

@section('dashboard-title', 'Dashboard')
@section('dashboard-subtitle', 'Gestiona tu contenido y proyectos')

@section('content')
  @include('dashboard.partials.publications-card')

  @include('dashboard.partials.projects-card')

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
