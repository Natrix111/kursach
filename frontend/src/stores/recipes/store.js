import { defineStore } from 'pinia'
import { ref } from 'vue'
import { recipesApi } from '@/api'
import { push } from 'notivue'
import { useRouter } from 'vue-router'
import { Routes } from '@/shared/index.js'

export const useStore = defineStore('recipes-store', () => {
  const recipes = ref([])
  const currentRecipe = ref(null)

  const router = useRouter()

  const getRecipes = async () => {
    recipes.value = (await recipesApi.getRecipes()).data
  }

  const getRecipeDetail = async (id, update = false) => {
    update ? null : (currentRecipe.value = null)
    currentRecipe.value = (await recipesApi.getRecipeDetail(id)).data
  }

  const createRecipe = async (model) => {
    try {
      const { data } = await recipesApi.createRecipe(model)

      push.success(data.message)

      console.log(data)
      // await router.push(`${Routes.recipe.path}/${data.id}`)
    } catch (error) {
      push.error(error.response.data.message)
      throw error
    }
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
    createRecipe,
    toggleFavoriteRecipe,
  }
})
