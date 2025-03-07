<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'old_password' => 'required|string',
            'new_password' => [
                'required',
                'string',
                'min:6',
                'max:128',
                'regex:/^(?=.*[A-Z])(?=.*[!#%&\'*+\-\/=?_`~])[A-Za-z0-9!#%&\'*+\-\/=?_`~]{6,128}$/'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'old_password.required' => 'Поле "Текущий пароль" обязательно для заполнения.',
            'old_password.string' => 'Текущий пароль должен быть строкой.',

            'new_password.required' => 'Поле "Новый пароль" обязательно для заполнения.',
            'new_password.string' => 'Новый пароль должен быть строкой.',
            'new_password.min' => 'Новый пароль должен содержать минимум 6 символов.',
            'new_password.max' => 'Новый пароль не должен превышать 128 символов.',
            'new_password.regex' => 'Новый пароль должен содержать хотя бы одну заглавную букву и один специальный символ (!#%&\'*+-/=?_`~).',
        ];
    }

}
