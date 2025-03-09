<template>
  <div class="recipe container">
    <recipe-slider :images="recipe.images" />

    <div class="recipe__info">
      <favorite-button
        :active="isFavorite"
        @click.prevent="toggleFavorite"
        class="recipe__favorite-button"
      />

      <div class="recipe__actions">
        <button class="recipe__edit btn btn--secondary" @click="openModal('edit-recipe')">
          ✏️ Редактировать
        </button>
        <button class="recipe__delete btn btn--danger">🗑 Удалить</button>
      </div>

      <h1 class="recipe__title">{{ recipe.title }}</h1>
      <p class="recipe__description">{{ recipe.description }}</p>

      <section class="recipe__section">
        <h2 class="recipe__section-title">Ингредиенты</h2>
        <ul class="recipe__ingredients">
          <li
            v-for="(ingredient, index) in recipe.ingredients"
            :key="index"
            class="recipe__ingredient"
          >
            {{ ingredient }}
          </li>
        </ul>
      </section>

      <section class="recipe__section">
        <h2 class="recipe__section-title">Инструкции</h2>
        <p class="recipe__instructions">{{ recipe.instructions }}</p>
      </section>

      <section class="recipe__section">
        <h2 class="recipe__section-title">Отзывы</h2>

        <review-form />

        <review-list :reviews="reviews" />
      </section>
    </div>
  </div>
  <recipe-edit-modal />
</template>

<script setup>
import { ref } from 'vue'
import { FavoriteButton } from '@/shared/index.js'
import RecipeSlider from '@/features/recipes/slider/ui/RecipeSlider.vue'
import { ReviewForm, ReviewList } from '@/features/index.js'
import { modalStore } from '@/stores'
import RecipeEditModal from '@/features/recipes/modal/ui/RecipeEditModal.vue'

const { openModal } = modalStore.useStore()

// Фиктивные данные рецепта
const recipe = {
  id: 3,
  user_id: 8,
  title: 'рецепт 1',
  description: 'описание',
  ingredients: ['хлеб', 'молоко'],
  instructions: `1. Нарежьте хлеб.\n2. Залейте молоком.\n3. Наслаждайтесь!`,
  images: [
    'http://localhost/api/storage/recipes/aeEmKaKzWmskvMYAtqdy3GgWG1APal84dSvIkIe0.png',
    'http://localhost/api/storage/recipes/EyMc3YOHa5buFCbq7XpMOI8hIptdc7FE2ygnmtbL.jpg',
    'http://localhost/api/storage/recipes/N8hcrc319ybcHbgOhGx42up1KDCDcyBRBZ3FwR1Q.jpg',
  ],
}

// Авторизован ли пользователь (здесь просто true для примера)
const isAuthenticated = ref(true)

// Избранное
const isFavorite = ref(false)
const toggleFavorite = () => {
  isFavorite.value = !isFavorite.value
}

// Отзывы (фиктивные данные)
const reviews = ref([
  {
    id: 1,
    name: 'Иван Петров',
    avatar: 'https://i.pravatar.cc/50?img=1',
    text: 'Отличный рецепт! Получилось очень вкусно.',
  },
  {
    id: 2,
    name: 'Анна Смирнова',
    avatar: 'https://i.pravatar.cc/50?img=2',
    text: 'Добавила немного специй, и вышло супер!',
  },
])

// Новый отзыв
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
