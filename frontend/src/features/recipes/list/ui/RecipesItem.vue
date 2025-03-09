<template>
  <router-link :to="{ name: Routes.recipe.name, params: { id: recipe.id } }">
    <article class="recipes-item">
      <img :src="recipe.images[0]" alt="Изображение рецепта" class="recipes-item__image" />
      <h3 class="recipes-item__title">{{ recipe.title }}</h3>
      <p class="recipes-item__description">{{ recipe.description }}</p>
      <favorite-button
        :active="recipe.is_favorite"
        @click.prevent="toggleFavorite"
        class="recipes-item__favorite-button"
      />
    </article>
  </router-link>
</template>

<script setup>
import { Routes } from '@/shared'
import { FavoriteButton } from '@/shared'
import { recipesStore } from '@/stores'

const props = defineProps({
  recipe: {
    type: Object,
    required: true,
  },
})

const { toggleFavoriteRecipe } = recipesStore.useStore()

const toggleFavorite = async () => {
  await toggleFavoriteRecipe(props.recipe.id, !props.recipe.is_favorite)
}
</script>

<style scoped lang="scss">
.recipes-item {
  @apply relative bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 cursor-pointer h-full;

  &__image {
    @apply w-full h-48 object-cover;
  }

  &__title {
    @apply font-serif text-xl font-bold text-dark px-4 pt-4;
  }

  &__description {
    @apply text-gray-700 px-4 pb-4;
  }

  &__favorite-button {
    @apply absolute top-2 right-2;
  }
}
</style>
