<footer class="footer" id="recursos">
  <div class="footer-brand">
    <a class="brand" href="{{ url('/') }}">
      <span class="brand-mark">
        <span></span>
        <span></span>
        <span></span>
      </span>
      <span>Publisys</span>
    </a>
    <p>&copy; {{ date('Y') }} Publisys. Todos los derechos reservados.</p>
  </div>
  <div class="footer-col">
    <h3>Producto</h3>
    <a href="{{ url('/#caracteristicas') }}">Características</a>
    <a href="{{ url('/#precios') }}">Precios</a>
    <a href="{{ route('proyectos') }}">Proyectos</a>
  </div>
  <div class="footer-col">
    <h3>Empresa</h3>
    <a href="#">Nosotros</a>
    <a href="{{ route('contacto') }}">Contáctame</a>
    <a href="#">Privacidad</a>
  </div>
  <div class="footer-col social">
    <h3>Siguenos</h3>
    <div>
      <a href="#" aria-label="Twitter">t</a>
      <a href="#" aria-label="LinkedIn">in</a>
      <a href="#" aria-label="GitHub">gh</a>
      <a href="#" aria-label="Instagram">ig</a>
    </div>
  </div>
</footer>
