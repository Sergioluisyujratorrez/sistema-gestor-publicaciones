<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProyectoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, list<string>> */
    public function rules(): array
    {
        return [
            'titulo' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'tipo' => ['required', 'in:sitio_web,aplicacion,dashboard,tienda_online,otro'],
            'imagen' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:1024'],
            'enlace' => ['nullable', 'url', 'max:500'],
            'categoria_id' => ['nullable', 'exists:categorias,id'],
            'tecnologias' => ['nullable', 'array'],
            'tecnologias.*' => ['exists:tecnologias,id'],
            'estado' => ['nullable', 'boolean'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'tipo.required' => 'El tipo de proyecto es obligatorio.',
            'tipo.in' => 'El tipo debe ser sitio web, aplicación, dashboard, tienda online u otro.',
            'imagen.mimes' => 'La imagen debe ser JPG, JPEG, PNG o WEBP.',
            'imagen.max' => 'La imagen no debe superar 1 MB.',
            'enlace.url' => 'El enlace debe ser una URL válida (incluye https://).',
        ];
    }
}
