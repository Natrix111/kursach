<template>
  <div class="auth-page">
    <router-view></router-view>
  </div>
</template>

<script setup></script>

<style scoped lang="scss">
.auth-page {
  @apply flex items-center justify-center bg-neutral p-4;
  min-height: calc(100vh - 64px);
}
</style>
