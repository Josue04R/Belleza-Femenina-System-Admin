<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        $clienteId = $this->cliente?->idCliente;

        return [
            'nombre' => 'required|max:50',
            'apellido' => 'required|max:50',
            'email' => [
                'required',
                'email',
                Rule::unique('clientes', 'email')->ignore($clienteId, 'idCliente'),
            ],
            'telefono' => 'nullable|max:20',
            'password' => $this->isMethod('post') ? 'required|min:6' : 'nullable|min:6',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'apellido.required' => 'El apellido es obligatorio.',
            'email.required' => 'El email es obligatorio.',
            'email.email' => 'Debe ser un correo válido.',
            'email.unique' => 'Este correo ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
        ];
    }
}
