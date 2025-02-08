<?php

namespace App\Http\Requests;

use App\Exceptions\FailedFormatOrSize;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdateAvatarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'avatar' => [
                'required',
                'image','mimes:jpeg,png,jpg','max:2048'
            ]
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new FailedFormatOrSize();
    }
}
