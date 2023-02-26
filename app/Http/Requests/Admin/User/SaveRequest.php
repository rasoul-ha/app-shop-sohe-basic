<?php

namespace App\Http\Requests\Admin\User;

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
            'name' => 'required|max:191',
            'email' => ['required', 'string',   'max:191','email', 'unique:users'],

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Enter the name',
            'email.required' => 'Enter the email',
            'email.max' =>'The email is invalid',
            'email.email' =>'The email is invalid',
            'email.unique' => 'The email is duplicate',
        ];
    }
}
