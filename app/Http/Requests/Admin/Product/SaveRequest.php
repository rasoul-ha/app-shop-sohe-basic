<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;
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
            'title' => ['required', 'max:191'],
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'product_option_size.*' => ['required', 'regex:/^([1-9][0-9]*)$/'],
            'product_option_price.*' => ['required', 'regex:/^([1-9][0-9]*|0)(\.[0-9]{2})?$/'],
            'product_option_quantity.*' => ['required', 'regex:/^([1-9][0-9]*)$/'],

        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Enter the title',
            'title.max' => 'The number of characters in the title exceeds the limit',
            'category_id.required' => 'Select a category',
            'category_id.exists' => 'The category is invalid',
            'product_option_size.*.required' => 'Enter the size',
            'product_option_size.*.regex' => 'The size is invalid',
            'product_option_price.*.required' => 'Enter the price',
            'product_option_price.*.regex' => 'The price is invalid',
            'product_option_quantity.*.required' => 'Enter the quantity',
            'product_option_quantity.*.regex' => 'The quantity is invalid',

        ];
    }
}
