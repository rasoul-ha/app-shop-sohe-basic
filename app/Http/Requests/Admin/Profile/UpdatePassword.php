<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
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
            'current_password' => 'required',
            'password'=> ['required','min:6']
        ];
    }
    public function messages()
    {
        return [
            'current_password.required' => 'Enter the current password',
            'password.required'=> 'Enter the new password' ,
            'password.min' =>'The password must have at least 6 characters.',
        ];
    }
}
