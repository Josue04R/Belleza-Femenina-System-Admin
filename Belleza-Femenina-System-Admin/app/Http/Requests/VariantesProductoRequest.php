<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VariantesProductoRequest extends FormRequest
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
            'idProducto' =>'required',
            'idTalla' => 'required',
			'color' => 'required|string',
			'stock' => 'required',
			'precio' => 'required',
        ];
    }
}
