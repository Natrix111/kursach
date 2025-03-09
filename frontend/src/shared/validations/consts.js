import * as yup from 'yup'

const LATIN = 'a-zA-Z'
const CYRILLIC = 'а-яА-Я'
const DIGITS = '0-9'
const SPECIAL_CHARS = "!#$%&'*+\\-/=?^_`{|}~"

export const usernameRegex = new RegExp(`^[${LATIN}${CYRILLIC}${DIGITS}${SPECIAL_CHARS}\\s]+$`)
export const passwordRegex = new RegExp(`^[${LATIN}${DIGITS}${SPECIAL_CHARS}]+$`)
export const specialCharRegex = new RegExp(`[${SPECIAL_CHARS}]`)

export const passwordValidation = yup
  .string()
  .required('Пароль обязателен')
  .min(6, 'Пароль должен быть не менее 6 символов')
  .max(128, 'Пароль должен быть не более 128 символов')
  .matches(/[A-Z]/, 'Пароль должен содержать хотя бы одну заглавную букву')
  .matches(
    specialCharRegex,
    "Пароль должен содержать хотя бы один специальный символ (! # $ % & ' * + - / = ? ^ _ ` { | } ~)",
  )
  .matches(
    passwordRegex,
    "Пароль может содержать только латиницу, цифры и разрешённые спецсимволы (! # $ % & ' * + - / = ? ^ _ ` { | } ~)",
  )
