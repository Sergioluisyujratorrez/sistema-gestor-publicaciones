<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tecnologia extends Model
{
    use SoftDeletes;

    /**
     * @var list<string>
     */
    protected $fillable = [
        'nombre',
        'slug',
        'icono',
        'color',
        'estado',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'estado' => 'boolean',
        ];
    }

    public function publicaciones(): BelongsToMany
    {
        return $this->belongsToMany(Publicacion::class, 'publicacion_tecnologia')->withTimestamps();
    }

    public function proyectos(): BelongsToMany
    {
        return $this->belongsToMany(Proyecto::class, 'proyecto_tecnologia')->withTimestamps();
    }
}
