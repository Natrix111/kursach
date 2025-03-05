<template>
  <div class="recipes container">
    <h2 class="recipes__title">Рецепты</h2>

    <div class="flex gap-4 w-full">
      <search-input v-model="searchQuery" placeholder="Поиск рецептов..." />
      <sort-select :options="sortOptions" v-model="selectedSort" />
    </div>

    <recipes-list :recipes="filteredAndSortedRecipes" />
    <router-link to="/recipes/new" class="add-recipe-button"> + Добавить рецепт </router-link>
  </div>
</template>

<script setup>
import { RecipesList } from '@/features'
import { ref, computed } from 'vue'
import { SearchInput, SortSelect } from '@/shared/index.js'

const recipes = ref([
  {
    id: 1,
    user_id: 8,
    title: 'Рецепт 1',
    description: 'описание',
    ingredients: ['хлеб', 'молоко'],
    instructions: 'инструкция',
    images: ['http://localhost/api/storage/recipes/2IQLdx9rR4A5zda90X2NPxkxiNJMM0Qc90ekOaaT.png'],
  },
  {
    id: 2,
    user_id: 8,
    title: 'Рецепт 2',
    description: 'описание',
    ingredients: ['хлеб', 'молоко', 'яйца'],
    instructions: 'инструкция',
    images: ['http://localhost/api/storage/recipes/yspByI6kr3LZsPB8YnV1qcCB7wEwCZPi1gOuSLcH.png'],
  },
  {
    id: 3,
    user_id: 8,
    title: 'Рецепт 3',
    description: 'описание',
    ingredients: ['хлеб'],
    instructions: 'инструкция',
    images: [
      'http://localhost/api/storage/recipes/aeEmKaKzWmskvMYAtqdy3GgWG1APal84dSvIkIe0.png',
      'http://localhost/api/storage/recipes/EyMc3YOHa5buFCbq7XpMOI8hIptdc7FE2ygnmtbL.jpg',
      'http://localhost/api/storage/recipes/N8hcrc319ybcHbgOhGx42up1KDCDcyBRBZ3FwR1Q.jpg',
    ],
  },
])

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
      return filteredRecipes.sort((a, b) => b.id - a.id) // По умолчанию сортируем по дате (id)
  }
})
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
