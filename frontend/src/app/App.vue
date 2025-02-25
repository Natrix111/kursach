<template>
  <header class="header">
    <h1 class="header__logo logo">ЕдаОК</h1>
    <nav class="header__nav">
      <router-link :to="Routes.home.path" class="header__nav-item">Главная</router-link>
      <router-link to="" class="header__nav-item">Каталог</router-link>
    </nav>
    <div class="header__auth">
      <template v-if="!isAuth">
        <router-link :to="`${Routes.auth.defaultPath}/login`" class="header__auth-item"
          >Войти</router-link
        >
        <router-link :to="`${Routes.auth.defaultPath}/register`" class="header__auth-item"
          >Зарегистрироваться</router-link
        >
      </template>
      <template v-else>
        <button @click="logout" class="header__auth-item">Выйти</button>
      </template>
    </div>
  </header>
  <div class="">
    <router-view></router-view>
  </div>
</template>

<script setup>
import { Routes } from '@/shared'
import { accountStore } from '@/stores'
import { storeToRefs } from 'pinia'

const { logout } = accountStore.useStore()
const { isAuth } = storeToRefs(accountStore.useStore())
</script>

<style lang="scss">
@import url('@/assets/css/main.scss');

.header {
  @apply bg-white shadow-md py-4 px-6 flex justify-between items-center;

  &__logo {
    @apply text-2xl font-bold text-orange-500;
  }

  &__nav {
    @apply flex space-x-6;

    &-item {
      @apply text-gray-700 hover:text-orange-500 transition-colors duration-200;
    }
  }

  &__auth {
    @apply flex space-x-4;

    &-item {
      @apply text-gray-700 hover:text-orange-500 transition-colors duration-200;
    }
  }
}

.container {
  @apply max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8;
}
</style>
