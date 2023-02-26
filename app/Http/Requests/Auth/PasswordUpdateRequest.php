<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
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
            'code' => ['required', 'string', 'digits:6'],
            'password' => ['required', 'string', 'min:6'],

        ];
    }
    public function messages()
    {
        return [
            'code.required' => 'Enter the confirmation code',
            'code.digits' =>'The verification code is invalid',
            'password.required' => 'Enter the password',
            'password.min' => 'Password must have at least 6 characters',
        ];
    }
}
