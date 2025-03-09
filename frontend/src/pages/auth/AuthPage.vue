<template>
  <div class="auth-page">
    <div class="auth-page__wrapper">
      <router-view></router-view>
    </div>
  </div>
</template>

<script setup></script>

<style scoped lang="scss">
.auth-page {
  @apply flex items-center justify-center bg-neutral p-4;
  min-height: calc(100vh - 64px);

  &__wrapper {
    @apply bg-white p-8 rounded-lg shadow-md w-full max-w-md;
  }
}
</style>
