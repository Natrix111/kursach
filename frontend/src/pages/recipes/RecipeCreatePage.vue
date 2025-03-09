<template>
  <div class="recipe-form container">
    <h1 class="recipe-form__title">{{ isEdit ? 'Редактировать рецепт' : 'Создать рецепт' }}</h1>
    <recipe-form :recipe="recipe" @submit="handleSubmit" />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { RecipeForm } from '@/features'

// Фиктивные данные рецепта (для редактирования)
const isEdit = ref(true) // Для переключения между режимом создания и редактирования
const recipe = ref({
  title: 'Рецепт 1',
  description: 'Описание рецепта',
  ingredients: ['Ингредиент 1', 'Ингредиент 2'],
  instructions: '1. Сделать это.\n2. Сделать то.',
  images: ['http://localhost/api/storage/recipes/aeEmKaKzWmskvMYAtqdy3GgWG1APal84dSvIkIe0.png'],
})

const handleSubmit = (formData) => {
  if (isEdit.value) {
    // Логика для редактирования рецепта
    console.log('Редактируем рецепт', formData)
  } else {
    // Логика для создания нового рецепта
    console.log('Создаем новый рецепт', formData)
  }
}
</script>

<style scoped lang="scss">
.recipe-form {
  @apply mx-auto my-6 max-w-4xl;

  &__title {
    @apply font-serif text-4xl font-bold text-dark mb-8;
  }
}
</style>
