<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdatePublicacionRequest extends FormRequest
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
            'tipo' => ['required', 'in:imagen,pdf,otro'],
            'archivo' => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,pdf', 'max:1024'],
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
            'tipo.required' => 'El tipo de publicación es obligatorio.',
            'tipo.in' => 'El tipo debe ser imagen, PDF u otro.',
            'archivo.mimes' => 'El archivo debe ser JPG, JPEG, PNG, WEBP o PDF.',
            'archivo.max' => 'El archivo no debe superar 1 MB.',
        ];
    }

    protected function failedValidation(Validator $validator): never
    {
        session()->flash('edit_publicacion_id', $this->route('publicacion')->id);

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
