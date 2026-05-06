@props([
    'title' => '',
    'description' => '',
    'author' => '',
    'imageClass' => '',
    'avatarClass' => '',
    'type' => '',
    'link' => '',
    'showMenu' => false,
    'imageStyle' => ''
])

<article {{ $attributes->merge(['class' => 'project-card']) }}>
  <div class="project-image {{ $imageClass }}" @if($imageStyle) style="{{ $imageStyle }}" @endif>
    @if($type)
      <span>{{ $type }}</span>
    @endif
  </div>
  <div class="project-body">
    <div class="card-title-row">
      <h3 style="margin: 0;">{{ $title }}</h3>
      @if($showMenu)
        <span class="dots-menu">&#8942;</span>
      @endif
    </div>
    <p>{{ $description }}</p>
    @if($link)
      <a class="ext-link" href="{{ $link }}" style="margin-bottom: 12px;">
        {{ str_replace(['https://', 'http://'], '', $link) }} 
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 4h6v6"/><path d="M20 4 10 14"/><path d="M20 14v6H4V4h6"/></svg>
      </a>
    @endif
    <div class="card-user-info">
      <div class="user-meta-small">
        <span class="avatar {{ $avatarClass }}" style="width: 20px; height: 20px;"></span>
        {{ $author }}
      </div>
      @if(!$link && !$showMenu)
        <a href="#" aria-label="Abrir proyecto {{ $title }}">&#8599;</a>
      @endif
    </div>
  </div>
</article>
