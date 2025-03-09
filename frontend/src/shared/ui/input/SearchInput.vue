<template>
  <div class="search">
    <input v-model="model" type="search" :placeholder="placeholder" class="search-input" />
  </div>
</template>

<script setup>
defineProps({
  placeholder: String,
})
const model = defineModel()
</script>

<style scoped lang="scss">
.search {
  @apply mb-8 w-full;

  .search-input {
    @apply w-full px-4 py-2 border-2 border-neutral rounded-lg focus:outline-none focus:border-secondary transition-colors duration-200;
  }
}
</style>
