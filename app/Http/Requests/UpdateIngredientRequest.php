<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIngredientRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            "name"=>"sometimes|string|min:2",
            "name_ar"=>"sometimes|string|min:2",
            "image"=>"sometimes|image",
            "total_quantity"=>"sometimes|numeric",
            "unit"=>"sometimes|string",
            "threshold"=>"sometimes|numeric",
        ];
    }
}
