<?php

namespace App\Http\Requests;

use App\Exceptions\FailedValidationException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => [
                'required',
                'string',
                'max:255',
                'regex:/^[A-Za-z0-9._+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/'
            ],
            'code' => 'required|string',
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
