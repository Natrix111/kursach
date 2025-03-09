<template>
  <div class="sorting">
    <select v-model="model" class="sort-select">
      <option v-for="option in options" :key="option.value" :value="option.value">
        {{ option.name }}
      </option>
    </select>
  </div>
</template>

<script setup>
defineProps({
  options: {
    type: Array,
    required: true,
  },
})
const model = defineModel()
</script>

<style scoped lang="scss">
.sorting {
  @apply mb-8;

  .sort-select {
    @apply px-4 py-2 border-2 border-neutral rounded-lg focus:outline-none focus:border-secondary transition-colors duration-200;
  }
}
</style>
