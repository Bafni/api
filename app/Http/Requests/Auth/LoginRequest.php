<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends ApiFormRequest
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
            'email' => 'required|email|string|max:255',
            'password' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'The email field cannot be empty',
            'email.email' => 'Email address is incorrect',
            'password.required' => 'The password field cannot be empty',
            'password' => 'Password address is incorrect',
            //'password.confirmed' => 'Passwords do not match'
        ];
    }
}
