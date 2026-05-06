@props([
    'title' => '',
    'time' => '',
    'thumbClass' => '',
    'avatarClass' => '',
    'type' => 'Imagen',
    'showMenu' => false,
    'thumbStyle' => ''
])

<article class="publication-card">
  <div class="thumb {{ $thumbClass }}" @if($thumbStyle) style="{{ $thumbStyle }}" @endif><span>{{ $type }}</span></div>
  <div class="card-body">
    <div class="card-title-row">
      <h3 style="margin: 0;">{{ $title }}</h3>
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
