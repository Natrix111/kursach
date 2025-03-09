<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'ingredients' => 'required|array|min:1|max:7',
            'ingredients.*' => 'string|max:50',
            'instructions' => 'required|string|max:1000',
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Название рецепта обязательно для заполнения.',
            'title.string' => 'Название рецепта должно быть строкой.',
            'title.max' => 'Название рецепта не должно превышать 50 символов.',
            'description.required' => 'Описание рецепта обязательно для заполнения.',
            'description.string' => 'Описание должно быть строкой.',
            'description.max' => 'Описание не должно превышать 255 символов.',
            'ingredients.required' => 'Ингредиенты обязательны для заполнения.',
            'ingredients.array' => 'Ингредиенты должны быть массивом.',
            'ingredients.min' => 'Должен быть указан как минимум один ингредиент.',
            'ingredients.max' => 'Максимальное количество ингредиентов — 7.',
            'ingredients.*.string' => 'Каждый ингредиент должен быть строкой.',
            'ingredients.*.max' => 'Каждый ингредиент не должен превышать 50 символов.',
            'instructions.required' => 'Инструкции обязательно для заполнения.',
            'instructions.string' => 'Инструкции должны быть строкой.',
            'instructions.max' => 'Инструкции не должны превышать 1000 символов.',
            'images.required' => 'Необходимо загрузить хотя бы одно изображение.',
            'images.array' => 'Изображения должны быть массивом.',
            'images.min' => 'Должно быть загружено как минимум одно изображение.',
            'images.max' => 'Максимальное количество изображений — 5.',
            'images.*.image' => 'Каждый файл должен быть изображением.',
            'images.*.mimes' => 'Каждое изображение должно быть формата jpeg, png, jpg или gif.',
            'images.*.max' => 'Каждое изображение не должно превышать 2 МБ.',
        ];
    }
}
