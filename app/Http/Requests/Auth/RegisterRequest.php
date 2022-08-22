<?php

namespace App\Http\Requests\Auth;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class RegisterRequest extends ApiFormRequest
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
            'email' => 'required|email|string|max:255|unique:users,email',
            'password' => 'required|string|max:255',
           // 'password_confirmation' => 'required|string|max:255',
        ];
    }
    public function messages()
    {
        return [
            'email.required' => 'The email field cannot be empty',
            'email.unique' => 'This mail already exists',
            'email.email' => 'Email address is incorrect',
            'password.required' => 'The password field cannot be empty',
            //'password.confirmed' => 'Passwords do not match'
        ];
    }

}
