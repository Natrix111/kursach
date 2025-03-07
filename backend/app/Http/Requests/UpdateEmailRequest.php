<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmailRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9._+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Поле "E-mail" обязательно для заполнения.',
            'email.string' => 'E-mail должен быть строкой.',
            'email.max' => 'E-mail не должен превышать 255 символов.',
            'email.regex' => 'Введите корректный E-mail в формате example@domain.com.',
        ];
    }

}
