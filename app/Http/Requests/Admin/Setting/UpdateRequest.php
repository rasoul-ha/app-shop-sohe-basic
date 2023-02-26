<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'app_name' => ['required', 'max:65535'],
            'app_mobile' => ['nullable', 'regex:/^[0-9]*$/'],
            'app_tax' => ['nullable', 'regex:/^[0-9]*$/'],
            'app_shipping_cost' => ['nullable', 'regex:/^[0-9]*$/'],
            'app_instagram' => ['nullable', 'url'],
            'app_address' => ['nullable', 'max:65535'],


        ];
    }
    public function messages()
    {
        return [
            'app_name.required' => 'Enter the name application',
            'app_name.max' => 'The number of characters in the application name is more than the allowed limit.',
            'app_mobile.regex' => 'The phone call is invalid',
            'app_tax.regex' => 'The tax percent is invalid',
            'app_shipping_cost.regex' => 'The shipping cost is invalid',
            'app_instagram.url' => 'The instagram url is invalid',
            'app_address.max' => 'The number of characters in the address is more than the limit',

        ];
    }

}
