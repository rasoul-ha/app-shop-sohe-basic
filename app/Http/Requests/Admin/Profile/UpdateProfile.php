<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfile extends FormRequest
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
            'name' => ['required','max:191'],
            'email' => ['required', 'string',  'max:191','email', 'unique:admins'],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Enter the name',
            'name.max' => "The number of characters in the name exceeds the limit",
            'email.required' => 'Enter the email',
            'email.max' =>'The email is invalid',
            'email.regex' => 'The email is invalid',
            'email.unique' => 'The email is duplicate',
        ];

    }
}
