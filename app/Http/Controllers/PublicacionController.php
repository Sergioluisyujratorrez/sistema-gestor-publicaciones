<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePublicacionRequest;
use App\Http\Requests\UpdatePublicacionRequest;
use App\Models\Categoria;
use App\Models\Publicacion;
use App\Models\Tecnologia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PublicacionController extends Controller
{
    public function index(): View
    {
        $publicaciones = Publicacion::with(['categoria', 'user'])
            ->latest()
            ->paginate(10);

        $categorias = Categoria::where('estado', true)
            ->whereIn('tipo', ['publicacion', 'ambos'])
            ->orderBy('nombre')
            ->get();

        $tecnologias = Tecnologia::where('estado', true)
            ->orderBy('nombre')
            ->get();

        return view('dashboard.publications', compact('publicaciones', 'categorias', 'tecnologias'));
    }

    public function store(StorePublicacionRequest $request): RedirectResponse
    {
        $path = $request->file('archivo')->store('publicaciones', 'public');

        $publicacion = Publicacion::create([
            'user_id' => auth()->id(),
            'categoria_id' => $request->categoria_id,
            'titulo' => $request->titulo,
            'slug' => $this->generateUniqueSlug($request->titulo),
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'archivo' => $path,
            'estado' => $request->boolean('estado', true),
            'publicado_en' => now(),
        ]);

        if ($request->filled('tecnologias')) {
            $publicacion->tecnologias()->sync($request->tecnologias);
        }

        return redirect()->route('dashboard.publicaciones')
            ->with('success', 'Publicación creada exitosamente.');
    }

    public function update(UpdatePublicacionRequest $request, Publicacion $publicacion): RedirectResponse
    {
        $data = [
            'categoria_id' => $request->categoria_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'estado' => $request->boolean('estado', true),
        ];

        if ($request->titulo !== $publicacion->titulo) {
            $data['slug'] = $this->generateUniqueSlug($request->titulo, $publicacion->id);
        }

        if ($request->hasFile('archivo')) {
            $data['archivo'] = $request->file('archivo')->store('publicaciones', 'public');
        }

        $publicacion->update($data);
        $publicacion->tecnologias()->sync($request->tecnologias ?? []);

        return redirect()->route('dashboard.publicaciones')
            ->with('success', 'Publicación actualizada exitosamente.');
    }

    private function generateUniqueSlug(string $titulo, ?int $excludeId = null): string
    {
        $slug = Str::slug($titulo);
        $original = $slug;
        $i = 1;

        while (Publicacion::where('slug', $slug)->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))->exists()) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
