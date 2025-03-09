<template>
  <h2 v-if="isLoadingUser">Загрузка</h2>
  <div v-else class="profile container">
    <div class="profile-header">
      <profile-avatar :avatar="user.avatar" />

      <input-edit :model="user.username" @save="saveName" />
      <input-edit :model="user.email" @save="saveEmail" />

      <button class="change-password-btn btn btn--secondary" @click="openModal('profile-password')">
        Сменить пароль
      </button>
      <router-link
        :to="`${Routes.auth.defaultPath}/email-confirm`"
        class="change-password-btn btn btn--secondary"
        v-if="!user.email_verify"
      >
        Подтвердить почту
      </router-link>
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
      <recipes-list v-if="activeTab === 'favorites'" :recipes="favoriteRecipes" />
      <recipes-list v-if="activeTab === 'my-recipes'" :recipes="myRecipes" />
    </div>
  </div>

  <profile-password-modal />
</template>

<script setup>
import { ref } from 'vue'
import { ProfileAvatar, RecipesList } from '@/features'
import { InputEdit, Routes } from '@/shared'
import { storeToRefs } from 'pinia'
import { accountStore, modalStore } from '@/stores'
import { ProfilePasswordModal } from '@/features'

const { changeUsername, changeEmail } = accountStore.useStore()
const { openModal } = modalStore.useStore()
const { user, isLoadingUser } = storeToRefs(accountStore.useStore())

const activeTab = ref('favorites')

const saveName = (newName) => {
  changeUsername(newName)
}

const saveEmail = (newEmail) => {
  changeEmail(newEmail)
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
</style>
