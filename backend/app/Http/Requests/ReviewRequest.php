<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'recipe_id' => 'required|exists:recipes,id',
            'comment' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'recipe_id.required' => 'Идентификатор рецепта обязателен.',
            'recipe_id.exists' => 'Выбранный рецепт не найден.',

            'comment.required' => 'Поле комментарий обязательно для заполнения.',
            'comment.string' => 'Комментарий должен быть текстом.',
            'comment.max' => 'Комментарий не должен превышать 1000 символов.',
        ];
    }
}
