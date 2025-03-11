<template>
  <template v-if="currentRecipe">
    <div class="recipe container">
      <recipe-slider :images="currentRecipe.images" />

      <div class="recipe__info">
        <favorite-button
          v-if="isAuth"
          :active="currentRecipe.is_favorite"
          @click.prevent="toggleFavorite"
          class="recipe__favorite-button"
        />

        <h1 class="recipe__title">{{ currentRecipe.title }}</h1>
        <p class="recipe__description">{{ currentRecipe.description }}</p>

        <section class="recipe__section">
          <h2 class="recipe__section-title">Ингредиенты</h2>
          <ul class="recipe__ingredients">
            <li
              v-for="(ingredient, index) in currentRecipe.ingredients"
              :key="index"
              class="recipe__ingredient"
            >
              {{ ingredient }}
            </li>
          </ul>
        </section>

        <section class="recipe__section">
          <h2 class="recipe__section-title">Инструкции</h2>
          <p class="recipe__instructions">{{ currentRecipe.instructions }}</p>

          <div v-if="currentRecipe.can_edit" class="recipe__actions">
            <button class="recipe__edit btn btn--secondary" @click="openModal('edit-recipe')">
              Редактировать
            </button>
            <button class="recipe__delete btn btn--danger" @click="openModal('delete-recipe')">
              Удалить
            </button>
          </div>
        </section>

        <section class="recipe__section">
          <h2 class="recipe__section-title">Отзывы</h2>

          <review-form @submit="(comment) => createReviews(route.params.id, comment)" />

          <review-list :reviews="currentRecipe.reviews" />
        </section>
      </div>
    </div>
    <recipe-edit-modal :recipe="currentRecipe" />
    <recipe-delete-modal />
  </template>
  <template v-else>
    <h2 class="load">Загрузка</h2>
  </template>
</template>

<script setup>
import { onMounted, onUnmounted, ref } from 'vue'
import { FavoriteButton } from '@/shared'
import {
  ReviewForm,
  ReviewList,
  RecipeSlider,
  RecipeEditModal,
  RecipeDeleteModal,
} from '@/features'
import { modalStore, recipesStore, accountStore } from '@/stores'
import { storeToRefs } from 'pinia'
import { useRoute } from 'vue-router'

const { getRecipeDetail, toggleFavoriteRecipe, createReviews } = recipesStore.useStore()
const { currentRecipe } = storeToRefs(recipesStore.useStore())
const { openModal } = modalStore.useStore()
const { isAuth } = storeToRefs(accountStore.useStore())

const route = useRoute()

const toggleFavorite = async () => {
  await toggleFavoriteRecipe(currentRecipe.value.id, !currentRecipe.value.is_favorite)
}

const newReview = ref('')

// Функция отправки отзыва
const submitReview = () => {
  if (!newReview.value.trim()) return

  reviews.value.push({
    id: reviews.value.length + 1,
    name: 'Вы', // В реальном приложении заменить на имя пользователя
    avatar: 'https://i.pravatar.cc/50?img=3', // В реальном приложении использовать аватар пользователя
    text: newReview.value.trim(),
  })

  newReview.value = '' // Очистить поле
}

onMounted(() => getRecipeDetail(route.params.id))
onUnmounted(() => (currentRecipe.value = null))
</script>

<style scoped lang="scss">
.recipe {
  @apply mx-auto my-6;

  &__info {
    @apply relative bg-white p-8 rounded-lg shadow-md;
  }

  &__favorite-button {
    @apply absolute top-4 right-4;
  }

  &__actions {
    @apply flex justify-end gap-4 mb-4;
  }

  &__edit {
    @apply bg-blue-500 text-white px-4 py-2 rounded-lg;
  }

  &__delete {
    @apply bg-red-500 text-white px-4 py-2 rounded-lg;
  }

  &__title {
    @apply font-serif text-4xl font-bold text-dark mb-4;
  }

  &__description {
    @apply text-gray-700 mb-8;
  }

  &__section {
    @apply mb-8;
  }

  &__section-title {
    @apply font-serif text-2xl font-bold text-dark mb-4;
  }

  &__ingredients {
    @apply list-disc list-inside;
  }

  &__ingredient {
    @apply text-gray-700 mb-2;
  }

  &__instructions {
    @apply text-gray-700;
    white-space: pre-line;
  }
}
</style>
