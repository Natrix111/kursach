<template>
  <form @submit.prevent="submit" class="login-form">
    <h2 class="login-form__title">Вход</h2>
    <form-field placeholder="Email" v-model="email" class="login-form__field" />
    <form-field placeholder="Пароль" v-model="password" type="password" class="login-form__field" />
    <button type="submit" class="login-form__button btn btn--primary">Войти</button>
  </form>
</template>

<script setup>
import { ref } from 'vue'
import { accountStore } from '@/stores'
import { FormField } from '@/shared'

const { login } = accountStore.useStore()

const email = ref(null)
const password = ref(null)

const submit = () => {
  if (email.value && password.value) login({ email: email.value, password: password.value })
}
</script>

<style scoped lang="scss">
.login-form {
  @apply bg-white p-8 rounded-lg shadow-md w-full max-w-md flex flex-col gap-4;

  &__title {
    @apply font-serif text-3xl font-bold text-dark text-center mb-2;
  }

  &__button {
    @apply w-full mt-4;
  }
}
</style>
