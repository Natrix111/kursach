<?php

namespace App\Http\Requests;

use App\Exceptions\FailedValidationException;
use Illuminate\Contracts\Validation\Validator;
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

    protected function failedValidation(Validator $validator)
    {
        throw new FailedValidationException();
    }
}
