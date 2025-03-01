<template>
  <form @submit.prevent="submit" class="login-form">
    <h2 class="login-form__title">Вход</h2>
    <form-field placeholder="Email" v-model="email" class="login-form__field" />
    <form-field placeholder="Пароль" v-model="password" type="password" class="login-form__field" />
    <div class="login-form__text-link text-link__wrapper">
      <router-link :to="`${Routes.auth.defaultPath}/register`" class="text-link"
        >У меня еще нет аккаунта</router-link
      >
    </div>
    <button type="submit" class="login-form__button btn btn--primary">Войти</button>
  </form>
</template>

<script setup>
import { ref } from 'vue'
import { accountStore } from '@/stores/index.js'
import { FormField, Routes } from '@/shared/index.js'

const { login } = accountStore.useStore()

const email = ref(null)
const password = ref(null)

const submit = () => {
  if (email.value && password.value) login({ email: email.value, password: password.value })
}
</script>

<style scoped lang="scss">
.login-form {
  @apply flex flex-col gap-4;

  &__title {
    @apply font-serif text-3xl font-bold text-dark text-center mb-2;
  }

  &__button {
    @apply w-full mt-4;
  }
}
</style>
