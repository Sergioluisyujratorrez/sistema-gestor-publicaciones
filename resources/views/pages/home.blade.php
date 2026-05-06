@extends('layouts.app')

@section('title', 'Publisys - Publicaciones digitales')

@section('content')
  <header class="hero">
    @include('partials.navbar')
    <section class="hero-grid">
      <div class="hero-copy">
        <p class="eyebrow">PUBLICA. COMPARTE. IMPACTA.</p>
        <h1>Tu contenido<br><span>Sin limites.</span></h1>
        <p class="hero-text">
          Publisys es el sistema de publicaciones digitales que te permite compartir imagenes,
          PDFs y proyectos enlaces de forma elegante y profesional.
        </p>
        <div class="hero-actions">
          <a class="btn btn-primary" href="{{ route('login') }}">Comenzar gratis <span>&rarr;</span></a>
          <a class="btn btn-secondary" href="#"><span class="play-icon"></span> Ver demo</a>
        </div>
        <div class="trust-list">
          <span><i>✓</i> Facil de usar</span>
          <span><i>●</i> Seguro y privado</span>
          <span><i>SS</i> Acceso desde cualquier lugar</span>
        </div>
      </div>

      <div class="hero-art" aria-label="Ilustracion creativa de Publisys">
        {{-- Aquí iría todo el arte CSS que moví a home.css --}}
        <div class="orbit orbit-one"></div>
        <div class="orbit orbit-two"></div>
        <div class="spark spark-a"></div>
        <div class="spark spark-b"></div>
        <div class="spark spark-c"></div>
        <div class="asset asset-image"></div>
        <div class="asset asset-pdf">PDF</div>
        <div class="asset asset-link"></div>
        <div class="asset asset-web"></div>
        <div class="portrait">
          <div class="hair"></div>
          <div class="face">
            <div class="brow brow-left"></div>
            <div class="brow brow-right"></div>
            <div class="eye eye-left"></div>
            <div class="eye eye-right"></div>
            <div class="glasses left-lens">ART</div>
            <div class="glasses right-lens">DESIGN</div>
            <div class="nose"></div>
            <div class="mouth"></div>
          </div>
          <div class="hand hand-left"></div>
          <div class="hand hand-right"></div>
          <div class="tablet">
            <span class="camera"></span>
          </div>
        </div>
      </div>
    </section>
  </header>

  <section class="section" id="caracteristicas">
    <div class="section-head">
      <h2>Galeria de publicaciones</h2>
      <a href="{{ route('galeria') }}">Ver todas <span>&rarr;</span></a>
    </div>

    <div class="publication-grid">
      <x-publication-card title="Montanas nevadas" time="Hace 2 horas" thumb-class="mountain" avatar-class="avatar-one" />
      <x-publication-card title="Informe anual 2024" time="Hace 5 horas" thumb-class="building-dark" avatar-class="avatar-two" type="PDF" />
      <x-publication-card title="Dashboard UI Kit" time="Hace 1 dia" thumb-class="dashboard-mini" avatar-class="avatar-three" type="Proyecto" />
      <x-publication-card title="Olas del oceano" time="Hace 2 dias" thumb-class="ocean" avatar-class="avatar-four" />
      <x-publication-card title="Sitio web corporativo" time="Hace 3 dias" thumb-class="concrete" avatar-class="avatar-one" type="Proyecto" />
      <x-publication-card title="Guia de marca" time="Hace 4 dias" thumb-class="document" avatar-class="avatar-three" type="PDF" />
    </div>
  </section>

  <section class="section project-section" id="proyectos">
    <div class="section-head">
      <h2>Proyectos destacados</h2>
      <a href="{{ route('proyectos') }}">Ver todos los proyectos <span>&rarr;</span></a>
    </div>

    <div class="project-grid">
      <x-project-card title="Fintech Dashboard" description="Dashboard administrativo para control de finanzas y analiticas." author="Carlos Mendoza" image-class="admin-preview" avatar-class="avatar-one" />
      <x-project-card title="SaaS Landing Page" description="Landing page moderna para SaaS startup tecnologica." author="Maria Lopez" image-class="landing-preview" avatar-class="avatar-two" />
      <x-project-card title="Portafolio Arquitectura" description="Sitio web minimalista para estudio de arquitectura." author="Juan Perez" image-class="portfolio-preview" avatar-class="avatar-four" />
    </div>
  </section>

  <section class="dashboard-band">
    <div class="dashboard-copy">
      <span>Dashboard</span>
      <h2>Gestiona todo desde un solo lugar</h2>
      <p>
        Un panel de control simple e intuitivo para gestionar tus publicaciones,
        proyectos y estadisticas en tiempo real.
      </p>
      <a class="btn btn-primary" href="{{ route('dashboard') }}">Ver dashboard</a>
    </div>

    <div class="dashboard-shell">
      <aside class="sidebar">
        <div class="side-brand">
          <span class="mini-mark"></span>
          Publisys
        </div>
        <a class="active" href="#"><span></span> Resumen</a>
        <a href="#"><span></span> Publicaciones</a>
        <a href="#"><span></span> Proyectos</a>
        <a href="#"><span></span> Analisis</a>
        <a href="#"><span></span> Favoritos</a>
        <a href="#"><span></span> Ajustes</a>
      </aside>
      <div class="dashboard-view">
        <div class="dash-top">
          <h3>Resumen</h3>
          <span><i class="avatar avatar-one"></i> Carlos Mendoza</span>
        </div>
        <div class="stats-grid">
          <div class="stat">
            <span>Publicaciones</span>
            <strong>128</strong>
            <small>+12% este mes</small>
          </div>
          <div class="stat">
            <span>Proyectos</span>
            <strong>24</strong>
            <small>+8% este mes</small>
          </div>
          <div class="stat">
            <span>Visualizaciones</span>
            <strong>5.4K</strong>
            <small>+16% este mes</small>
          </div>
          <div class="stat">
            <span>Descargas</span>
            <strong>1.2K</strong>
            <small>+19% este mes</small>
          </div>
        </div>
        <div class="dash-bottom">
          <div class="chart-panel">
            <div class="panel-head">
              <strong>Visualizaciones</strong>
              <span>Ultimos 7 dias</span>
            </div>
            <div class="chart">
              <span style="--h: 35%"></span>
              <span style="--h: 52%"></span>
              <span style="--h: 44%"></span>
              <span style="--h: 72%"></span>
              <span style="--h: 38%"></span>
              <span style="--h: 50%"></span>
              <span style="--h: 82%"></span>
              <span style="--h: 56%"></span>
              <span style="--h: 74%"></span>
              <span style="--h: 63%"></span>
              <span style="--h: 91%"></span>
            </div>
          </div>
          <div class="activity-panel">
            <strong>Actividad reciente</strong>
            <p><span></span>Nueva publicacion <small>Hace 2 horas</small></p>
            <p><span></span>Proyecto actualizado <small>Hace 5 horas</small></p>
            <p><span></span>Nuevo comentario <small>Hace 1 dia</small></p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="cta-section" id="precios">
    <div class="cta-icon">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <div>
      <h2>&iquest;Listo para empezar?</h2>
      <p>Unete a miles de creadores y equipos que ya publican y comparten su contenido con Publisys.</p>
    </div>
    <div class="cta-actions">
      <a class="btn btn-primary" href="{{ route('login') }}">Comenzar gratis</a>
      <a class="btn btn-outline" href="#">Hablar con ventas</a>
    </div>
  </section>
@endsection
