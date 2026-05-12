<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class UpdateCategoriaRequest extends FormRequest
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

    protected function failedValidation(Validator $validator): never
    {
        session()->flash('edit_categoria_id', $this->route('categoria')->id);

        throw (new ValidationException($validator))
            ->errorBag($this->errorBag)
            ->redirectTo($this->getRedirectUrl());
    }
}
