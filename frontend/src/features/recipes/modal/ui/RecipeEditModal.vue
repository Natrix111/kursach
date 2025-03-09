<template>
  <app-modal name="edit-recipe">
    <div class="edit-recipe">
      <app-icon name="cross" class="edit-recipe__close" @click="openModal(null)" />
      <h2 class="edit-recipe__title">Редактировать рецепт</h2>

      <recipe-form :recipe="recipe" @submit="handleSubmit" />
    </div>
  </app-modal>
</template>

<script setup>
import { modalStore } from '@/stores'
import { AppIcon } from '@/shared'
import RecipeForm from '@/features/recipes/form/ui/RecipeForm.vue'
import { ref } from 'vue'
import { AppModal } from '@/stores/index.js'

const { openModal } = modalStore.useStore()

// Фиктивные данные рецепта для редактирования
const recipe = ref({
  title: 'Рецепт 1',
  description: 'Описание рецепта',
  ingredients: ['Ингредиент 1', 'Ингредиент 2'],
  instructions: '1. Сделать это.\n2. Сделать то.',
  images: ['http://localhost/api/storage/recipes/aeEmKaKzWmskvMYAtqdy3GgWG1APal84dSvIkIe0.png'],
})

const handleSubmit = (formData) => {
  console.log('Обновленные данные рецепта:', formData)
  openModal(null) // Закрытие модалки после сохранения
}
</script>

<style scoped lang="scss">
.edit-recipe {
  @apply bg-white rounded-2xl p-10 flex flex-col gap-6 relative w-[30rem];

  &__close {
    @apply absolute top-4 right-4 cursor-pointer text-gray-600;
  }

  &__title {
    @apply text-2xl font-bold text-center;
  }
}
</style>
