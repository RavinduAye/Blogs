<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class RegisterRequest extends FormRequest
{
    public function rules()
    {
        return [
            'first_name' => 'required|max:150',
            'last_name' => 'required|max:150',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors()
        ], 400));
    }

    public function messages(): array
    {
        return [
            'first_name.required' => 'First name is required.',
            'first_name.max' => 'First name should not be greater than 150 characters.',
            'last_name.required' => 'Last name is required.',
            'last_name.max' => 'Last name should not be greater than 150 characters.',
            'email.required' => 'Email is required.',
            'email.email' => 'Email is invalid.',
            'email.unique' => 'The email has already been taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password should not be less than 6 characters.',
            'confirm_password.required' => 'Confirm password is required.',
            'confirm_password.same' => 'Confirm password should be same as password.'
        ];
    }
}
