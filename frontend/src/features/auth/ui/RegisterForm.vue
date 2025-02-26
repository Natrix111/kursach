<template>
  <form class="register-form" @submit.prevent="submit">
    <h2 class="register-form__title">Регистрация</h2>
    <form-field
      placeholder="Имя пользователя"
      v-model="username"
      :error="errors.username"
      class="register-form__field"
    />
    <form-field
      placeholder="Email"
      v-model="email"
      :error="errors.email"
      class="register-form__field"
    />
    <form-field
      placeholder="Пароль"
      type="password"
      v-model="password"
      :error="errors.password"
      class="register-form__field"
    />
    <form-field
      placeholder="Пароль"
      type="password"
      v-model="passwordConfirm"
      :error="errors.passwordConfirm"
      class="register-form__field"
    />
    <div class="login-form__text-link text-link__wrapper">
      <router-link :to="`${Routes.auth.defaultPath}/login`" class="text-link"
        >Уже есть аккаунт</router-link
      >
    </div>
    <button :disabled="!isValid" class="login-form__button btn btn--primary">Войти</button>
  </form>
</template>

<script setup>
import { registerSchema } from '../lib'
import { useForm } from 'vee-validate'
import { computed } from 'vue'
import { FormField, Routes } from '@/shared'
import { accountStore } from '@/stores'

const { meta, errors, handleSubmit, defineField } = useForm({
  validationSchema: registerSchema,
})

const { register } = accountStore.useStore()

const [username] = defineField('username')
const [email] = defineField('email')
const [password] = defineField('password')
const [passwordConfirm] = defineField('passwordConfirm')

const isValid = computed(() => meta.value.valid)

const submit = handleSubmit((values) => register(values))
</script>

<style scoped lang="scss">
.register-form {
  @apply flex flex-col gap-4;

  &__title {
    @apply font-serif text-3xl font-bold text-dark text-center mb-2;
  }

  &__button {
    @apply w-full mt-4;
  }
}
</style>
