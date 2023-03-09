<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
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
            "email" => "required|email",
            "password" => "required",
        ];
    }

    public function messages()
    {
        return [
            'email.required'     =>'يجب أن تدخل البريد الإلكتروني',
            'email.email'        =>'يجب أن تدخل عنوان البريد بشكل صحيح',
            'password.required'  =>'يجب أن تدخل كلمة مرور',
        ];
    }
}
