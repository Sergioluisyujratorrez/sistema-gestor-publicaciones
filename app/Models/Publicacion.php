<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Publicacion extends Model
{
    use SoftDeletes;

    protected $table = 'publicaciones';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'categoria_id',
        'titulo',
        'slug',
        'descripcion',
        'tipo',
        'archivo',
        'imagen_portada',
        'estado',
        'vistas',
        'publicado_en',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'estado' => 'boolean',
            'vistas' => 'integer',
            'publicado_en' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }

    public function tecnologias(): BelongsToMany
    {
        return $this->belongsToMany(Tecnologia::class, 'publicacion_tecnologia')->withTimestamps();
    }
}
