<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsernameRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Поле "Имя пользователя" обязательно для заполнения.',
            'username.string' => 'Имя пользователя должно быть строкой.',
            'username.max' => 'Имя пользователя не должно превышать 255 символов.',
        ];
    }

}
