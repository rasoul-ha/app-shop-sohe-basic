<?php

namespace App\Http\Requests\User\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required', 'max:191'],
            'email' => ['required', 'unique:users,email'],
            'password' => 'required|min:6',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Enter the full name',
            'name.max' => 'Fullname are invalid',
            'email.required' => 'Enter the email',
            'email.unique' => "The email is duplicate",
            'password.required' => 'Enter the password',
            'password.min' => 'The password must be at least :min char'
        ];
    }
}
