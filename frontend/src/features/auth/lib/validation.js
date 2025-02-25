import * as yup from 'yup'
import { passwordValidation, usernameRegex } from '@/shared/validations'

// export const loginSchema = {
//   login: yup.string().email('Поле не соответствует формату'),
//   password: passwordValidation,
// }

export const registerSchema = yup.object({
  username: yup
    .string()
    .required('Имя пользователя обязательно')
    .test(
      'not-only-spaces',
      'Поле не должно состоять только из пробелов',
      (value) => value?.trim().length > 0,
    )
    .matches(
      usernameRegex,
      "Поле может содержать только латиницу, кириллицу, цифры и разрешённые спецсимволы (! # $ % & ' * + - / = ? ^ _ ` { | } ~)",
    )
    .min(1, 'Поле должно содержать хотя бы 1 символ')
    .max(255, 'Поле должно содержать не более 255 символов'),
  email: yup
    .string()
    .required('Email обязателен')
    .email('Email должен соответствовать формату почты'),
  password: passwordValidation,
  passwordConfirm: yup
    .string()
    .required('Подтверждение пароля обязательно')
    .oneOf([yup.ref('password')], 'Пароли не совпадают. Пожалуйста, повторите ввод.'),
})
