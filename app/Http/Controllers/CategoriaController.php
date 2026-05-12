<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use App\Models\Categoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    public function index(Request $request): View
    {
        $q = trim((string) $request->query('q_cat', ''));
        $tipo = $request->query('tipo_cat');

        $categorias = Categoria::query()
            ->when($q !== '', fn ($query) => $query->where('nombre', 'like', "%{$q}%"))
            ->when(in_array($tipo, ['publicacion', 'proyecto', 'ambos'], true), fn ($query) => $query->where('tipo', $tipo))
            ->latest()
            ->paginate(3)
            ->withQueryString();

        return view('dashboard.categories', compact('categorias'));
    }

    public function store(StoreCategoriaRequest $request): RedirectResponse
    {
        Categoria::create([
            'nombre' => $request->nombre,
            'slug' => $this->generateUniqueSlug($request->nombre),
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'estado' => $request->boolean('estado', true),
        ]);

        return redirect()->route('dashboard.categorias')
            ->with('success', 'Categoría creada exitosamente.');
    }

    public function update(UpdateCategoriaRequest $request, Categoria $categoria): RedirectResponse
    {
        $data = [
            'nombre' => $request->nombre,
            'tipo' => $request->tipo,
            'descripcion' => $request->descripcion,
            'estado' => $request->boolean('estado', true),
        ];

        if ($request->nombre !== $categoria->nombre) {
            $data['slug'] = $this->generateUniqueSlug($request->nombre, $categoria->id);
        }

        $categoria->update($data);

        return redirect()->route('dashboard.categorias')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    public function toggleEstado(Categoria $categoria): RedirectResponse
    {
        $categoria->update(['estado' => ! $categoria->estado]);

        $mensaje = $categoria->estado
            ? 'Categoría activada exitosamente.'
            : 'Categoría desactivada exitosamente.';

        return redirect()->route('dashboard.categorias')->with('success', $mensaje);
    }

    private function generateUniqueSlug(string $nombre, ?int $excludeId = null): string
    {
        $slug = Str::slug($nombre);
        $original = $slug;
        $i = 1;

        while (Categoria::where('slug', $slug)->when($excludeId, fn ($q) => $q->where('id', '!=', $excludeId))->exists()) {
            $slug = "{$original}-{$i}";
            $i++;
        }

        return $slug;
    }
}
