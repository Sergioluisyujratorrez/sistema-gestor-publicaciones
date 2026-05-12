<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProyectoRequest;
use App\Http\Requests\UpdateProyectoRequest;
use App\Models\Categoria;
use App\Models\Proyecto;
use App\Models\Tecnologia;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProyectoController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q_proy', ''));
        $tipo = $request->query('tipo_proy');

        $proyectos = Proyecto::with(['categoria', 'user'])
            ->when($q !== '', fn ($query) => $query->where('titulo', 'like', "%{$q}%"))
            ->when(in_array($tipo, ['sitio_web', 'aplicacion', 'dashboard', 'tienda_online', 'otro'], true), fn ($query) => $query->where('tipo', $tipo))
            ->latest()
            ->paginate(3)
            ->withQueryString();

        $categorias = Categoria::where('estado', true)
            ->whereIn('tipo', ['proyecto', 'ambos'])
            ->orderBy('nombre')
            ->get();

        $tecnologias = Tecnologia::where('estado', true)
            ->orderBy('nombre')
            ->get();

        return view('dashboard.projects', compact('proyectos', 'categorias', 'tecnologias'));
    }

    public function store(StoreProyectoRequest $request): RedirectResponse
    {
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('proyectos', 'public');
        }

        $proyecto = Proyecto::create([
            'user_id' => auth()->id(),
            'categoria_id' => $request->categoria_id,
            'titulo' => $request->titulo,
            'slug' => $this->generateUniqueSlug($request->titulo),
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'imagen' => $imagenPath,
            'enlace' => $request->enlace,
            'estado' => $request->boolean('estado', true),
            'publicado_en' => now(),
        ]);

        if ($request->filled('tecnologias')) {
            $proyecto->tecnologias()->sync($request->tecnologias);
        }

        return redirect()->route('dashboard.proyectos')
            ->with('success', 'Proyecto creado exitosamente.');
    }

    public function update(UpdateProyectoRequest $request, Proyecto $proyecto): RedirectResponse
    {
        $data = [
            'categoria_id' => $request->categoria_id,
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'tipo' => $request->tipo,
            'enlace' => $request->enlace,
            'estado' => $request->boolean('estado', true),
        ];

        if ($request->titulo !== $proyecto->titulo) {
            $data['slug'] = $this->generateUniqueSlug($request->titulo, $proyecto->id);
        }

        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('proyectos', 'public');
        }

        $proyecto->update($data);
        $proyecto->tecnologias()->sync($request->tecnologias ?? []);

        return redirect()->route('dashboard.proyectos')
            ->with('success', 'Proyecto actualizado exitosamente.');
    }

    public function toggleEstado(Proyecto $proyecto): RedirectResponse
    {
        $proyecto->update(['estado' => ! $proyecto->estado]);

        $mensaje = $proyecto->estado
            ? 'Proyecto activado exitosamente.'
            : 'Proyecto desactivado exitosamente.';

        return redirect()->route('dashboard.proyectos')->with('success', $mensaje);
    }

    private function generateUniqueSlug(string $titulo, ?int $excludeId = null): string
    {
        $slug = Str::slug($titulo);
        $original = $slug;
        $i = 1;

        while (Proyecto::where('slug', $slug)->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))->exists()) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
