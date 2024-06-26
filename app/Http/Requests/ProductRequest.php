<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'discount' => 'required',
            'ingredient' => 'required',
            'description' => 'required',
            'category_id' => 'required|integer',
            'image' => 'file|image|mimes:jpeg,png,jpg,gif,webp|max:2048',


        ];
    }
}
