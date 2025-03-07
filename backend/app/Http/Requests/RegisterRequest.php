<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => [
                'required',
                'string',
                'max:255',
                'regex:/^(?!\s*$)[A-Za-zА-Яа-яёЁ!#%&\'*+\-\/=?_~\s]+$/u',
            ],
            'email' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9._+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/'
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'max:128',
                'regex:/^(?=.*[A-Z])(?=.*[!#%&\'*+\-\/=?_`~])[A-Za-z0-9!#%&\'*+\-\/=?_`~]{6,128}$/'
            ]
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Поле "Имя пользователя" обязательно для заполнения.',
            'username.string' => 'Имя пользователя должно быть строкой.',
            'username.max' => 'Имя пользователя не должно превышать 255 символов.',
            'username.regex' => 'Имя пользователя может содержать только буквы, пробелы и специальные символы (!#%&\'*+-/=?_~).',

            'email.required' => 'Поле "E-mail" обязательно для заполнения.',
            'email.string' => 'E-mail должен быть строкой.',
            'email.max' => 'E-mail не должен превышать 255 символов.',
            'email.regex' => 'Введите корректный E-mail в формате example@domain.com.',

            'password.required' => 'Поле "Пароль" обязательно для заполнения.',
            'password.string' => 'Пароль должен быть строкой.',
            'password.min' => 'Пароль должен содержать минимум 6 символов.',
            'password.max' => 'Пароль не должен превышать 128 символов.',
            'password.regex' => 'Пароль должен содержать хотя бы одну заглавную букву и один специальный символ (!#%&\'*+-/=?_`~).',
        ];
    }

}
