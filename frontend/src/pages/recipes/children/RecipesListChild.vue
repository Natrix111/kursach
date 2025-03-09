<template>
  <div class="recipes container">
    <h2 class="recipes__title">Рецепты</h2>

    <div class="flex gap-4 w-full items-center">
      <search-input v-model="searchQuery" placeholder="Поиск рецептов..." />
      <sort-select :options="sortOptions" v-model="selectedSort" />
    </div>

    <recipes-list :recipes="filteredAndSortedRecipes" />
    <router-link :to="`${Routes.recipes.path}/create`" class="add-recipe-button">
      + Добавить рецепт
    </router-link>
  </div>
</template>

<script setup>
import { RecipesList } from '@/features'
import { Routes, SearchInput, SortSelect } from '@/shared'
import { recipesStore } from '@/stores'
import { ref, computed, onMounted } from 'vue'
import { storeToRefs } from 'pinia'

const { getRecipes } = recipesStore.useStore()
const { recipes } = storeToRefs(recipesStore.useStore())

const sortOptions = [
  { name: 'По дате', value: 'date' },
  { name: 'По названию', value: 'title' },
  { name: 'По количеству ингредиентов', value: 'ingredients' },
]

const searchQuery = ref('')
const selectedSort = ref('date')

const filteredAndSortedRecipes = computed(() => {
  let filteredRecipes = recipes.value

  if (searchQuery.value) {
    const query = searchQuery.value.toLowerCase()
    filteredRecipes = filteredRecipes.filter(
      (recipe) =>
        recipe.title.toLowerCase().includes(query) ||
        recipe.description.toLowerCase().includes(query) ||
        recipe.ingredients.some((ingredient) => ingredient.toLowerCase().includes(query)),
    )
  }

  switch (selectedSort.value) {
    case 'title':
      return filteredRecipes.sort((a, b) => a.title.localeCompare(b.title))
    case 'ingredients':
      return filteredRecipes.sort((a, b) => a.ingredients.length - b.ingredients.length)
    default:
      return filteredRecipes.sort((a, b) => b.id - a.id)
  }
})

onMounted(() => getRecipes())
</script>

<style scoped lang="scss">
.recipes {
  &__title {
    @apply text-4xl text-black mb-9;
  }
}

.add-recipe-button {
  @apply fixed bottom-8 right-8 px-6 py-3 bg-primary text-white rounded-lg shadow-md hover:bg-orange-600 transition-colors duration-200;
}
</style>
