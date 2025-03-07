<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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

    public function messages(): array
    {
        return [
            'avatar.required' => 'Вы должны загрузить изображение для аватара.',
            'avatar.image' => 'Файл должен быть изображением.',
            'avatar.mimes' => 'Аватар должен быть в формате: JPEG, JPG или PNG.',
            'avatar.max' => 'Размер аватара не должен превышать 2MB.',
        ];
    }

}
