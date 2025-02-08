<?php

namespace App\Http\Requests;

use App\Exceptions\FailedValidationException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

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

    protected function failedValidation(Validator $validator)
    {
        throw new FailedValidationException();
    }
}
