<template>
  <div class="recipes-item">
    <img
      src="@/assets/img/event-item-test.jpg"
      alt="Изображение рецепта"
      class="recipes-item__image"
    />
    <h3 class="recipes-item__title">{{ recipe.title }}</h3>
    <p class="recipes-item__description">{{ recipe.description }}</p>
  </div>
</template>

<script setup>
defineProps({
  recipe: {
    type: Object,
    required: true,
  },
})
</script>

<style scoped lang="scss">
.recipes-item {
  @apply bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-300 hover:scale-105 cursor-pointer;

  &__image {
    @apply w-full h-48 object-cover;
  }

  &__title {
    @apply font-serif text-xl font-bold text-dark px-4 pt-4;
  }

  &__description {
    @apply text-gray-700 px-4 pb-4;
  }
}
</style>
