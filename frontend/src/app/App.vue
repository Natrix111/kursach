<template>
  <header>
    <img alt="Vue logo" class="logo" src="../assets/logo.svg" width="125" height="125" />

    <div class="wrapper">
      <hello-world msg="You did it!" />

      <nav class="nav">
        <router-link to="/" class="nav-link">Home</router-link>
        <router-link to="/about" class="text-2xl">About</router-link>
      </nav>
    </div>
  </header>

  <router-view />
</template>

<script setup>
import { RouterLink, RouterView } from 'vue-router'
import HelloWorld from '@/features/HelloWorld.vue'
</script>

<style lang="scss">
@import url('@/assets/css/main.scss');
</style>
