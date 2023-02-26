<?php

namespace App\Http\Requests\Admin\Banner;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class SaveRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'product_id' => ['required', Rule::exists('products', 'id')],
            'image' => ['required', Rule::exists('images', 'id')],

        ];
    }
    public function messages()
    {
        return [
            'category_id.required' => 'Select a category',
            'category_id.exists' => 'The category is invalid',
            'category_id.required' => 'Select a product',
            'category_id.exists' => 'The product is invalid',
            'image.required' => 'Select a image',
            'image.exists' => 'The image is invalid',

        ];
    }
}
