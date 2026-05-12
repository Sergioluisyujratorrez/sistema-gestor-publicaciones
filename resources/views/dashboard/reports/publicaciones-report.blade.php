<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reporte de publicaciones</title>
  <style>
    @page { margin: 60px 40px 50px; }
    body { font-family: DejaVu Sans, sans-serif; font-size: 11px; color: #1f2937; }
    h1 { font-size: 18px; margin: 0 0 4px; color: #1e3a8a; }
    .meta { color: #6b7280; font-size: 10px; margin-bottom: 16px; }
    .filtros { background: #f3f4f6; padding: 8px 12px; border-left: 3px solid #1e3a8a; margin-bottom: 14px; font-size: 10px; }
    table { width: 100%; border-collapse: collapse; }
    thead { background: #1e3a8a; color: #fff; }
    th, td { padding: 8px 10px; text-align: left; border-bottom: 1px solid #e5e7eb; }
    th { font-size: 10px; text-transform: uppercase; letter-spacing: .03em; }
    tbody tr:nth-child(even) { background: #f9fafb; }
    .badge { display: inline-block; padding: 2px 8px; border-radius: 10px; font-size: 9px; font-weight: 700; }
    .badge-imagen { background: #dbeafe; color: #1e40af; }
    .badge-pdf { background: #fee2e2; color: #b91c1c; }
    .badge-otro { background: #e5e7eb; color: #374151; }
    .estado-activo { color: #15803d; font-weight: 700; }
    .estado-inactivo { color: #9ca3af; }
    .footer { position: fixed; bottom: -30px; left: 0; right: 0; text-align: center; font-size: 9px; color: #9ca3af; }
    .total { margin-top: 14px; font-weight: 700; }
    .empty { padding: 30px; text-align: center; color: #6b7280; }
  </style>
</head>
<body>
  <h1>Reporte de publicaciones</h1>
  <div class="meta">
    Generado el {{ $generadoEn->format('d/m/Y H:i') }}
  </div>

  @if($filtroQ || $filtroTipo)
    <div class="filtros">
      <strong>Filtros aplicados:</strong>
      @if($filtroQ) Búsqueda: "{{ $filtroQ }}". @endif
      @if($filtroTipo) Tipo: {{ ucfirst($filtroTipo) }}. @endif
    </div>
  @endif

  @if($publicaciones->isEmpty())
    <div class="empty">No se encontraron publicaciones con los filtros aplicados.</div>
  @else
    <table>
      <thead>
        <tr>
          <th style="width:6%;">#</th>
          <th style="width:46%;">Título</th>
          <th style="width:14%;">Tipo</th>
          <th style="width:14%;">Estado</th>
          <th style="width:20%;">Fecha</th>
        </tr>
      </thead>
      <tbody>
        @foreach($publicaciones as $i => $publicacion)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>
              <strong>{{ $publicacion->titulo }}</strong>
              @if($publicacion->categoria)
                <br><span style="color:#6b7280; font-size:9px;">{{ $publicacion->categoria->nombre }}</span>
              @endif
            </td>
            <td>
              <span class="badge badge-{{ $publicacion->tipo }}">{{ ucfirst($publicacion->tipo) }}</span>
            </td>
            <td class="{{ $publicacion->estado ? 'estado-activo' : 'estado-inactivo' }}">
              {{ $publicacion->estado ? 'Activo' : 'Inactivo' }}
            </td>
            <td>{{ $publicacion->created_at->format('d/m/Y H:i') }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="total">Total de publicaciones: {{ $publicaciones->count() }}</div>
  @endif

  <div class="footer">Publisys — Reporte de publicaciones</div>
</body>
</html>
