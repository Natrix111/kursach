<template>
  <div class="recipe-detail">
    <div class="recipe-gallery">
      <img :src="activeImage" alt="Изображение рецепта" class="recipe-main-image" />
      <div class="recipe-thumbnails">
        <img
          v-for="(image, index) in recipe.images"
          :key="index"
          :src="image"
          alt="Изображение рецепта"
          class="thumbnail"
          :class="{ 'thumbnail-active': activeImage === image }"
          @click="activeImage = image"
        />
      </div>
    </div>

    <!-- Основная информация о рецепте -->
    <div class="recipe-info">
      <h1 class="recipe-title">{{ recipe.title }}</h1>
      <p class="recipe-description">{{ recipe.description }}</p>

      <!-- Ингредиенты -->
      <div class="recipe-section">
        <h2 class="section-title">Ингредиенты</h2>
        <ul class="ingredients-list">
          <li
            v-for="(ingredient, index) in recipe.ingredients"
            :key="index"
            class="ingredient-item"
          >
            {{ ingredient }}
          </li>
        </ul>
      </div>

      <!-- Инструкции -->
      <div class="recipe-section">
        <h2 class="section-title">Инструкции</h2>
        <p class="instructions">{{ recipe.instructions }}</p>
      </div>

      <!-- Кнопка добавления в избранное -->
      <button @click="toggleFavorite" class="favorite-button">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-8 w-8"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          :class="{ 'text-primary': isFavorite, 'text-gray-400': !isFavorite }"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"
          />
        </svg>
        <span class="favorite-text">{{ isFavorite ? 'В избранном' : 'Добавить в избранное' }}</span>
      </button>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'

const recipe = {
  id: 3,
  user_id: 8,
  title: 'рецепт 1',
  description: 'описание',
  ingredients: ['хлеб', 'молоко'],
  instructions: `1. Нарежьте хлеб. фыв
  2. Залейте молоком.
  3. Наслаждайтесь!`,
  images: [
    'http://localhost/api/storage/recipes/aeEmKaKzWmskvMYAtqdy3GgWG1APal84dSvIkIe0.png',
    'http://localhost/api/storage/recipes/EyMc3YOHa5buFCbq7XpMOI8hIptdc7FE2ygnmtbL.jpg',
    'http://localhost/api/storage/recipes/N8hcrc319ybcHbgOhGx42up1KDCDcyBRBZ3FwR1Q.jpg',
  ],
}

const activeImage = ref(recipe.images[0])
const isFavorite = ref(false)

const toggleFavorite = () => {
  isFavorite.value = !isFavorite.value
}
</script>

<style scoped lang="scss">
.recipe-detail {
  @apply max-w-6xl mx-auto p-6;
}

.recipe-gallery {
  @apply mb-8;

  .recipe-main-image {
    @apply w-full h-96 object-cover rounded-lg shadow-md;
  }

  .recipe-thumbnails {
    @apply flex gap-4 mt-4 overflow-x-auto;

    .thumbnail {
      @apply w-24 h-24 object-cover rounded-lg cursor-pointer transition-opacity duration-200;

      &:hover {
        @apply opacity-75;
      }

      &-active {
        @apply border-2 border-primary;
      }
    }
  }
}

.recipe-info {
  @apply bg-white p-8 rounded-lg shadow-md;

  .recipe-title {
    @apply font-serif text-4xl font-bold text-dark mb-4;
  }

  .recipe-description {
    @apply text-gray-700 mb-8;
  }

  .recipe-section {
    @apply mb-8;

    .section-title {
      @apply font-serif text-2xl font-bold text-dark mb-4;
    }

    .ingredients-list {
      @apply list-disc list-inside;

      .ingredient-item {
        @apply text-gray-700 mb-2;
      }
    }

    .instructions {
      @apply text-gray-700;
    }
  }

  .favorite-button {
    @apply flex items-center gap-2 px-6 py-2 bg-white border-2 border-primary rounded-lg text-primary hover:bg-primary hover:text-white transition-colors duration-200;

    svg {
      @apply h-6 w-6;
    }

    .favorite-text {
      @apply font-sans font-bold;
    }
  }
}
</style>
