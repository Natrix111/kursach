import * as yup from 'yup'
import { passwordRegex, specialCharRegex } from '@/shared/validations'
import { passwordValidation } from '@/shared/validations'

export const passwordSchema = yup.object({
  password: passwordValidation.notOneOf(
    [yup.ref('oldPassword')],
    'Новый пароль не должен совпадать со старым',
  ),
  passwordConfirm: yup
    .string()
    .required('Подтверждение пароля обязательно')
    .oneOf([yup.ref('password')], 'Пароли не совпадают. Пожалуйста, повторите ввод.'),

  oldPassword: yup
    .string()
    .required('Старый пароль обязателен')
    .matches(
      passwordRegex,
      "Пароль может содержать только латиницу, цифры и разрешённые спецсимволы (! # $ % & ' * + - / = ? ^ _ ` { | } ~)",
    )
    .min(6, 'Пароль должен быть не менее 6 символов')
    .max(128, 'Пароль должен быть не более 128 символов')
    .matches(/[A-Z]/, 'Пароль должен содержать хотя бы одну заглавную букву')
    .matches(
      specialCharRegex,
      "Пароль должен содержать хотя бы один специальный символ (! # $ % & ' * + - / = ? ^ _ ` { | } ~)",
    ),
})
