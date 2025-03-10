<template>
  <app-modal name="edit-recipe">
    <div class="edit-recipe">
      <app-icon name="cross" class="edit-recipe__close" @click="openModal(null)" />
      <h2 class="edit-recipe__title">Редактировать рецепт</h2>

      <recipe-form :recipe="recipe" :server-errors="serverErrors" @submit="submit" />
    </div>
  </app-modal>
</template>

<script setup>
import { modalStore, AppModal, recipesStore } from '@/stores'
import { AppIcon } from '@/shared'
import { RecipeForm } from '@/features'
import { ref } from 'vue'
import { useRoute } from 'vue-router'

defineProps({
  recipe: {
    type: Object,
    required: true,
  },
})

const route = useRoute()
const serverErrors = ref({})

const { openModal } = modalStore.useStore()
const { updateRecipe } = recipesStore.useStore()

const submit = async (values) => {
  const formData = new FormData()

  for (const [key, value] of Object.entries(values)) {
    if (['images'].includes(key)) value.forEach((option) => formData.append(`${key}[]`, option))
    else if (['ingredients'].includes(key))
      value.split(',').forEach((option) => formData.append(`${key}[]`, option))
    else formData.append(key, value)
  }

  try {
    await updateRecipe(route.params.id, formData)
    serverErrors.value = {}
    openModal(null)
  } catch (error) {
    if (error.response?.data?.errors) {
      serverErrors.value = error.response.data.errors
    }
  }
}
</script>

<style scoped lang="scss">
.edit-recipe {
  @apply bg-white rounded-2xl p-10 flex flex-col gap-6 relative w-[30rem];

  &__close {
    @apply absolute top-4 right-4 h-4 w-4 cursor-pointer text-gray-600;
  }

  &__title {
    @apply text-2xl font-bold text-center;
  }
}
</style>
