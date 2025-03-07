<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'comment' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'comment.required' => 'Поле комментарий обязательно для заполнения.',
            'comment.string' => 'Комментарий должен быть текстом.',
            'comment.max' => 'Комментарий не должен превышать 1000 символов.',
        ];
    }
}
