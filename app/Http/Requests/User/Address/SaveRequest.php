<?php

namespace App\Http\Requests\User\Address;

use Illuminate\Foundation\Http\FormRequest;

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
            'street_name' => ['required',  'max:191'],
            'city' => ['required',  'max:191'],
            'state' => ['required',  'max:191'],
            'zip_code' => ['required',  'max:191'],

        ];
    }
    public function messages()
    {
        return [
            'street_name.required' => 'Enter the address',
            'street_name.max' => "The number of characters in the street name exceeds the limit",
            'city.required' => 'Enter the city',
            'city.max' => "The number of characters in the city exceeds the limit",
            'state.required' => 'Enter the state',
            'state.max' => "The number of characters in the state exceeds the limit",
            'zip_code.required' => 'Enter the zip code',
            'zip_code.max' => "The number of characters in the zip code exceeds the limit",
        ];
    }
}
