<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermisoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
			'idPermiso' => 'required',
			'nombrePermiso' => 'required|string',
			'categoriaProductos' => 'required|boolean',
			'productos' => 'required|boolean',
			'tallas' => 'required|boolean',
			'variantesProducto' => 'required|boolean',
			'empleados' => 'required|boolean',
			'permisos' => 'required|boolean',
			'registroVentas' => 'required|boolean',
			'ventas' => 'required|boolean',
			'compras' => 'required|boolean',
			'pedidos' => 'required|boolean',
			'gastosOperativos' => 'required|boolean',
			'inventario' => 'required|boolean',
			'clientes' => 'required|boolean',
        ];
    }
}
