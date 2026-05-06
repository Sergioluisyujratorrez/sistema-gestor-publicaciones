@extends('layouts.app')

@section('title', 'Publisys - Contáctame')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/pages/contact.css') }}">
@endpush

@section('content')
  <header class="header-light">
    @include('partials.navbar')
  </header>

  <div class="contact-wrapper">
    <div class="contact-grid">
      <!-- Columna Izquierda: Información de contacto -->
      <aside class="info-column">
        <h2>Información de contacto</h2>
        
        <div class="info-item">
          <div class="info-icon-box">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <div class="info-content">
            <h3>Email</h3>
            <p>hola@publisys.com</p>
            <small>Te responderemos en menos de 24 horas.</small>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon-box" style="background: #3b59ff;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
          </div>
          <div class="info-content">
            <h3>Teléfono</h3>
            <p>+34 600 123 456</p>
            <small>Lunes a Viernes de 9:00 a 18:00</small>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon-box" style="background: #2563ff;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <div class="info-content">
            <h3>Ubicación</h3>
            <p>Madrid, España</p>
            <small>Atendemos clientes en todo el mundo.</small>
          </div>
        </div>

        <div class="info-item">
          <div class="info-icon-box" style="background: #6366f1;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
          </div>
          <div class="info-content">
            <h3>Horario</h3>
            <p>Lunes a Viernes</p>
            <small>9:00 - 18:00 (GMT+1)</small>
          </div>
        </div>

        <div class="meeting-card">
          <div class="meeting-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 28px;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
          </div>
          <h3>¿Prefieres hablar en persona?</h3>
          <p>Agenda una reunión con nuestro equipo y conversemos sobre tu proyecto.</p>
          <a href="#" class="btn btn-outline" style="background: #fff; border-color: var(--line); color: var(--text); display: flex; align-items: center; gap: 8px;">
            Agendar reunión
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 16px;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          </a>
        </div>
      </aside>

      <!-- Columna Derecha: Formulario de mensaje -->
      <section class="form-card">
        <h2>Envíanos un mensaje</h2>
        <p class="subtitle">Cuéntanos sobre tu proyecto y te ayudaremos a hacerlo realidad.</p>

        <form action="#">
          <div class="form-grid">
            <div class="form-group">
              <label>Nombre completo</label>
              <input type="text" class="text-input" placeholder="Tu nombre completo" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" class="text-input" placeholder="tu@email.com" required>
            </div>
          </div>

          <div class="form-group" style="margin-bottom: 24px;">
            <label>Empresa (opcional)</label>
            <input type="text" class="text-input" placeholder="Nombre de tu empresa">
          </div>

          <div class="form-group" style="margin-bottom: 24px;">
            <label>Asunto</label>
            <select class="text-input">
              <option value="">¿En qué podemos ayudarte?</option>
              <option value="presupuesto">Solicitar presupuesto</option>
              <option value="soporte">Soporte técnico</option>
              <option value="otro">Otro asunto</option>
            </select>
          </div>

          <div class="form-group" style="margin-bottom: 24px;">
            <label>Mensaje</label>
            <textarea class="text-input" rows="6" placeholder="Cuéntanos más sobre tu proyecto, necesidades o cualquier pregunta que tengas..." required style="resize: none;"></textarea>
          </div>

          <div class="form-footer-note">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width: 14px;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
            Tu información está segura con nosotros. No compartimos tus datos.
          </div>

          <button type="submit" class="btn btn-primary btn-block" style="height: 54px; font-size: 16px; display: flex; align-items: center; justify-content: center; gap: 12px;">
            Enviar mensaje
            <svg viewBox="0 0 24 24" fill="currentColor" style="width: 18px;"><path d="m3.4 20.4 17.45-7.48a1 1 0 0 0 0-1.84L3.4 3.6a1 1 0 0 0-1.39 1.21L5 12l-2.99 7.19a1 1 0 0 0 1.39 1.21Z"/></svg>
          </button>
        </form>
      </section>
    </div>

    <!-- Sección de FAQs -->
    <section class="faq-section">
      <div class="faq-header">
        <div>
          <h2>Preguntas frecuentes</h2>
          <p>Encuentra respuestas rápidas a las dudas más comunes.</p>
        </div>
        <a href="#" class="faq-link">Ver todas las FAQs &rarr;</a>
      </div>

      <div class="faq-grid">
        <div class="faq-card">
          <div class="faq-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" style="width: 18px;"><circle cx="12" cy="12" r="10"/><path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"/><line x1="12" y1="17" x2="12.01" y2="17"/></svg>
          </div>
          <h3>¿Cuánto tiempo tardan en responder?</h3>
          <p>Respondemos todos los mensajes en menos de 24 horas hábiles.</p>
          <a href="#" class="card-link">Ver respuesta &rarr;</a>
        </div>

        <div class="faq-card">
          <div class="faq-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" style="width: 18px;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
          </div>
          <h3>¿Qué tipo de proyectos aceptan?</h3>
          <p>Trabajamos con todo tipo de contenido digital: PDFs, imágenes, enlaces y más.</p>
          <a href="#" class="card-link">Ver respuesta &rarr;</a>
        </div>

        <div class="faq-card">
          <div class="faq-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" style="width: 18px;"><polygon points="5 3 19 12 5 21 5 3"/></svg>
          </div>
          <h3>¿Ofrecen demo del producto?</h3>
          <p>Sí, puedes probar Publisys gratis durante 14 días sin compromiso.</p>
          <a href="#" class="card-link">Ver respuesta &rarr;</a>
        </div>

        <div class="faq-card">
          <div class="faq-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" style="width: 18px;"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
          </div>
          <h3>¿Necesito tarjeta de crédito para empezar?</h3>
          <p>No, no necesitas tarjeta de crédito para comenzar tu prueba gratuita.</p>
          <a href="#" class="card-link">Ver respuesta &rarr;</a>
        </div>
      </div>
    </section>

    <!-- Banner Inferior -->
    <div class="bottom-banner">
      <div class="banner-logo">
        <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width: 32px;"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
      </div>
      <div class="banner-content">
        <h2>¿Listo para comenzar?</h2>
        <p>Únete a miles de creadores y equipos que ya publican y comparten su contenido con Publisys.</p>
      </div>
      <div class="banner-actions">
        <a href="{{ route('login') }}" class="btn btn-primary" style="height: 48px; padding: 0 24px; display: flex; align-items: center;">Comenzar gratis</a>
        <a href="#" class="btn btn-outline" style="height: 48px; padding: 0 24px; display: flex; align-items: center; border-color: rgba(255,255,255,0.2); color: #fff;">Hablar con ventas</a>
      </div>
    </div>
  </div>
@endsection
