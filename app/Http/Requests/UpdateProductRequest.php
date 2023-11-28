<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            "description"=>"sometimes|string",
            "description_ar"=>"sometimes|string",
            "image"=>"sometimes|image",
            'position'=>"sometimes|integer",
            'status'=>"sometimes|boolean",
            "price"=>"sometimes|numeric",
            "estimated_time"=>"sometimes|string",
            "category_id"=>"sometimes|exists:categories,id",

        ];
    }
}
