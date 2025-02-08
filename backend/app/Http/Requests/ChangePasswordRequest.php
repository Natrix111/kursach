<?php

namespace App\Http\Requests;

use App\Exceptions\FailedValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

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

    protected function failedValidation(Validator $validator)
    {
        throw new FailedValidationException();
    }
}
