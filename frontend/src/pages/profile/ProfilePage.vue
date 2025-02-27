<template>
  <div class="profile container">
    <div class="profile-header">
      <profile-avatar :avatar="user.avatar" />

      <input-edit :model="user.name" />
      <input-edit :model="user.email" />

      <button class="change-password-btn">Сменить пароль</button>
    </div>

    <div class="profile-tabs">
      <button
        @click="activeTab = 'favorites'"
        :class="['tab-button', { 'tab-button--active': activeTab === 'favorites' }]"
      >
        Избранные рецепты
      </button>
      <button
        @click="activeTab = 'my-recipes'"
        :class="['tab-button', { 'tab-button--active': activeTab === 'my-recipes' }]"
      >
        Мои рецепты
      </button>
    </div>

    <div class="profile-content">
      <div v-if="activeTab === 'favorites'" class="favorites-tab">
        <div class="recipe-grid">
          <div v-for="recipe in favoriteRecipes" :key="recipe.id" class="recipe-card">
            <img
              src="@/assets/img/event-item-test.jpg"
              alt="Изображение рецепта"
              class="recipe-image"
            />
            <h3 class="recipe-title">{{ recipe.title }}</h3>
            <p class="recipe-description">{{ recipe.description }}</p>
          </div>
        </div>
      </div>
      <div v-if="activeTab === 'my-recipes'" class="my-recipes-tab">
        <div class="recipe-grid">
          <div v-for="recipe in myRecipes" :key="recipe.id" class="recipe-card">
            <img
              src="@/assets/img/event-item-test.jpg"
              alt="Изображение рецепта"
              class="recipe-image"
            />
            <h3 class="recipe-title">{{ recipe.title }}</h3>
            <p class="recipe-description">{{ recipe.description }}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import ProfileAvatar from '@/features/profile/avatar/ProfileAvatar.vue'
import InputEdit from '@/shared/ui/input/InputEdit.vue'

const user = ref({
  avatar: 'https://via.placeholder.com/150',
  name: 'Иван Иванов',
  email: 'ivan@example.com',
  emailVerified: false,
})

const activeTab = ref('favorites')
const isChangePasswordModalOpen = ref(false)

// Редактирование имени
const isEditingName = ref(false)
const editedName = ref('')

const startEditingName = () => {
  editedName.value = user.value.name
  isEditingName.value = true
}

const saveName = () => {
  user.value.name = editedName.value
  isEditingName.value = false
}

const cancelEditingName = () => {
  isEditingName.value = false
}

// Редактирование почты
const isEditingEmail = ref(false)
const editedEmail = ref('')

const startEditingEmail = () => {
  editedEmail.value = user.value.email
  isEditingEmail.value = true
}

const saveEmail = () => {
  user.value.email = editedEmail.value
  user.value.emailVerified = false
  isEditingEmail.value = false
}

const cancelEditingEmail = () => {
  isEditingEmail.value = false
}

const favoriteRecipes = ref([
  {
    id: 1,
    image: 'https://via.placeholder.com/300',
    title: 'Спагетти Карбонара',
    description: 'Классический итальянский рецепт.',
  },
  {
    id: 2,
    image: 'https://via.placeholder.com/300',
    title: 'Тирамису',
    description: 'Нежный десерт с кофе и маскарпоне.',
  },
])

const myRecipes = ref([
  {
    id: 1,
    image: 'https://via.placeholder.com/300',
    title: 'Печенье с шоколадом',
    description: 'Мягкое и ароматное печенье.',
  },
  {
    id: 2,
    image: 'https://via.placeholder.com/300',
    title: 'Суп Том Ям',
    description: 'Острый тайский суп с креветками.',
  },
])
</script>

<style scoped lang="scss">
.profile {
  @apply mx-auto p-6 bg-white mt-8 rounded-lg shadow-md;
}

.profile-header {
  @apply text-center mb-8 flex flex-col items-center gap-3;

  .change-password-btn {
    @apply bg-secondary text-white px-6 py-2 rounded-lg hover:bg-green-600 transition-colors duration-200;
  }
}

.profile-tabs {
  @apply flex justify-center mb-8;

  .tab-button {
    @apply px-6 py-2 font-sans font-bold text-gray-700 transition-colors duration-200;

    &--active {
      @apply text-primary border-b-2 border-primary;
    }
  }
}

.profile-content {
  @apply bg-white p-6 rounded-lg;
}

.recipe-grid {
  @apply grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6;
}

.recipe-card {
  @apply bg-white rounded-lg shadow-md overflow-hidden transition-transform duration-200 hover:scale-105;

  .recipe-image {
    @apply w-full h-48 object-cover;
  }

  .recipe-title {
    @apply font-serif text-xl font-bold text-dark px-4 pt-4;
  }

  .recipe-description {
    @apply text-gray-700 px-4 pb-4;
  }
}
</style>
