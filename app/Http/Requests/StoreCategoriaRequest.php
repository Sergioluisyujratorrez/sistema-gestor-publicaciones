<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /** @return array<string, list<string>> */
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'tipo' => ['required', 'in:publicacion,proyecto,ambos'],
            'descripcion' => ['nullable', 'string'],
            'estado' => ['nullable', 'boolean'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'tipo.required' => 'El tipo es obligatorio.',
            'tipo.in' => 'El tipo debe ser publicación, proyecto o ambos.',
        ];
    }
}
