<template>
  <div class="recipes-list">
    <recipes-item v-for="recipe in recipes" :key="recipe.id" :recipe="recipe" />
  </div>
</template>

<script setup>
import RecipesItem from './RecipesItem.vue'

defineProps({
  recipes: {
    type: Array,
    required: true,
  },
})
</script>

<style scoped lang="scss">
.recipes-list {
  @apply grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6;
}
</style>
