<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Cambia según tu lógica de autorización
    }

    public function rules(): array
    {
        return [
            'nombreProducto' => 'required|string|max:255',
            'marcaProducto' => 'required|string|max:255',
            'idCategoria' => 'required|exists:categorias,idCategoria',
            'material' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'imagen' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', // Validación de archivo
            'estado' => 'required|string|max:255',
        ];
    }
}
