import { defineStore } from 'pinia'
import { ref } from 'vue'
import { recipesApi } from '@/api'
import { push } from 'notivue'

export const useStore = defineStore('recipes-store', () => {
  const recipes = ref([])
  const currentRecipe = ref(null)

  const getRecipes = async () => {
    recipes.value = (await recipesApi.getRecipes()).data
  }

  const getRecipeDetail = async (id, update = false) => {
    update ? null : (currentRecipe.value = null)
    currentRecipe.value = (await recipesApi.getRecipeDetail(id)).data
  }

  const toggleFavoriteRecipe = async (id, add = true) => {
    try {
      const { data } = await (add
        ? recipesApi.addToFavoriteRecipe(id)
        : recipesApi.deleteFromFavoriteRecipe(id))

      push.success(data.message)

      getRecipeDetail(id, true)
      getRecipes()
    } catch (error) {
      push.error(error.response.data.error)
    }
  }

  return {
    recipes,
    currentRecipe,
    getRecipes,
    getRecipeDetail,
    toggleFavoriteRecipe,
  }
})
