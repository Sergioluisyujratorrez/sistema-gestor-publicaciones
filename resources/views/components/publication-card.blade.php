@props([
    'title' => '',
    'time' => '',
    'thumbClass' => '',
    'avatarClass' => '',
    'type' => 'Imagen',
    'showMenu' => false,
    'thumbStyle' => '',
    'archivo' => null,
])

@php
    $extension = $archivo ? strtolower(pathinfo($archivo, PATHINFO_EXTENSION)) : '';
    $esPdf = $extension === 'pdf' || $type === 'PDF';
    $archivoUrl = $archivo ? asset('storage/'.$archivo) : '';
    $clickable = (bool) $archivo;
@endphp

<article class="publication-card">
  @if($archivo)
    @if($esPdf)
      <button type="button" class="thumb thumb-clickable"
              style="background:#fef2f2; display:flex; align-items:center; justify-content:center; border:0; cursor:pointer; padding:0; width:100%;"
              onclick="verPublicacion(this)"
              data-archivo="{{ $archivoUrl }}"
              data-tipo="pdf"
              data-titulo="{{ $title }}">
        <svg viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="1.5" width="32" height="32"><path d="M14 3H6a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"/><path d="M14 3v6h6"/></svg>
      </button>
    @else
      <button type="button" class="thumb thumb-clickable"
              style="padding:0; overflow:hidden; border:0; cursor:pointer; width:100%; background:transparent;"
              onclick="verPublicacion(this)"
              data-archivo="{{ $archivoUrl }}"
              data-tipo="imagen"
              data-titulo="{{ $title }}">
        <img src="{{ $archivoUrl }}" alt="{{ $title }}" style="width:100%; height:100%; object-fit:cover; display:block;">
      </button>
    @endif
  @else
    <div class="thumb {{ $thumbClass }}" @if($thumbStyle) style="{{ $thumbStyle }}" @endif><span>{{ $type }}</span></div>
  @endif

  <div class="card-body">
    <div class="card-title-row">
      @if($clickable)
        <h3 style="margin: 0; cursor: pointer;"
            onclick="verPublicacion(this)"
            data-archivo="{{ $archivoUrl }}"
            data-tipo="{{ $esPdf ? 'pdf' : 'imagen' }}"
            data-titulo="{{ $title }}">{{ $title }}</h3>
      @else
        <h3 style="margin: 0;">{{ $title }}</h3>
      @endif
      @if($showMenu)
        <span class="dots-menu">&#8942;</span>
      @endif
    </div>
    @if($showMenu)
      <p class="meta" style="margin-top: 8px;">{{ $time }}</p>
      <div class="card-user-info">
        <div class="user-meta-small">
          <span class="avatar {{ $avatarClass }}" style="width: 20px; height: 20px;"></span>
          Carlos Mendoza
        </div>
      </div>
    @else
      <div class="meta">
        <span>{{ $time }}</span>
        <span class="avatar {{ $avatarClass }}"></span>
      </div>
    @endif
  </div>
</article>
