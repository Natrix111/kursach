<template>
  <div class="recipe-create container">
    <h1 class="recipe-create__title">{{ isEdit ? 'Редактировать рецепт' : 'Создать рецепт' }}</h1>
    <recipe-form :server-errors="serverErrors" @submit="submit" />
  </div>
</template>

<script setup>
import { RecipeForm } from '@/features'
import { recipesStore } from '@/stores'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const { createRecipe } = recipesStore.useStore()

const serverErrors = ref({})

const submit = async (values) => {
  const formData = new FormData()

  for (const [key, value] of Object.entries(values)) {
    if (['images'].includes(key)) value.forEach((option) => formData.append(`${key}[]`, option))
    else if (['ingredients'].includes(key))
      value.split(',').forEach((option) => formData.append(`${key}[]`, option))
    else formData.append(key, value)
  }

  try {
    await createRecipe(formData)
    serverErrors.value = {}
  } catch (error) {
    if (error.response?.data?.errors) {
      serverErrors.value = error.response.data.errors
    }
  }
}
</script>

<style scoped lang="scss">
.recipe-create {
  @apply mx-auto my-6 max-w-4xl bg-white rounded-lg shadow-md;

  &__title {
    @apply font-serif text-4xl font-bold text-dark mb-8;
  }
}
</style>
