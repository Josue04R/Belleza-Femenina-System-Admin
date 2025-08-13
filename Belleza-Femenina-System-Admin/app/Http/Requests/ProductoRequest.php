<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
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
			'nombre_p' => 'required|string',
			'marca_p' => 'required|string',
			'id_cate' => 'required',
			'material' => 'required|string',
			'descripcion' => 'required|string',
			'precio' => 'required',
			'estado' => 'required|string',
        ];
    }
}
