import * as yup from 'yup'

export const recipeSchema = yup.object({
  title: yup
    .string()
    .required('Название рецепта обязательно')
    .min(3, 'Название должно содержать хотя бы 3 символа')
    .max(255, 'Название не должно превышать 255 символов'),

  description: yup
    .string()
    .required('Описание обязательно')
    .min(10, 'Описание должно содержать хотя бы 10 символов'),

  ingredients: yup
    .string()
    .required('Ингредиенты обязательны')
    .test(
      'not-only-spaces',
      'Поле не должно состоять только из пробелов',
      (value) => value?.trim().length > 0,
    ),

  instructions: yup
    .string()
    .required('Инструкция обязательна')
    .min(10, 'Инструкция должна содержать хотя бы 10 символов'),
})
