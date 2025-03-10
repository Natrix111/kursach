<template>
  <app-modal name="delete-recipe">
    <div class="delete-recipe">
      <h2 class="delete-recipe__title">Удалить рецепт?</h2>
      <div class="delete-recipe__buttons">
        <button @click="deleteRecipeHandler" class="btn btn--outline">Да</button>
        <button @click="openModal(null)" class="btn btn--primary">Нет</button>
      </div>
    </div>
  </app-modal>
</template>

<script setup>
import { modalStore, recipesStore, AppModal } from '@/stores'
import { useRoute } from 'vue-router'

const route = useRoute()

const { openModal } = modalStore.useStore()
const { deleteRecipe } = recipesStore.useStore()

const deleteRecipeHandler = async () => {
  await deleteRecipe(route.params.id)
  openModal(null)
}
</script>

<style scoped lang="scss">
.delete-recipe {
  @apply bg-white rounded-2xl p-10 flex flex-col gap-6 relative w-[30rem];

  &__title {
    @apply text-2xl font-bold text-center;
  }

  &__buttons {
    @apply flex justify-center gap-6;
  }
}
</style>
