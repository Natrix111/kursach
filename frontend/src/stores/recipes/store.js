import { defineStore } from 'pinia'
import { ref } from 'vue'
import { recipesApi } from '@/api'
import { push } from 'notivue'
import { useRouter } from 'vue-router'
import { Routes } from '@/shared'

export const useStore = defineStore('recipes-store', () => {
  const recipes = ref([])
  const currentRecipe = ref(null)

  const router = useRouter()

  const getRecipes = async () => {
    recipes.value = (await recipesApi.getRecipes()).data
  }

  const getRecipeDetail = async (id) => {
    try {
      currentRecipe.value = (await recipesApi.getRecipeDetail(id)).data
    } catch {
      await router.push(Routes.recipes.path)
    }
  }

  const createRecipe = async (model) => {
    try {
      const { data } = await recipesApi.createRecipe(model)

      push.success(data.message)

      console.log(data)
      // await router.push(`${Routes.recipe.path}/${data.id}`)
      await router.push(Routes.recipes.path)
    } catch (error) {
      push.error(error.response.data.message)
      throw error
    }
  }

  const deleteRecipe = async (id) => {
    try {
      const { data } = await recipesApi.deleteRecipe(id)

      push.success(data.message)

      await router.push(Routes.recipes.path)
    } catch (error) {
      push.error(error.response.data.error)
    }
  }

  const updateRecipe = async (id, model) => {
    try {
      const { data } = await recipesApi.updateRecipe(id, model)

      push.success(data.message)

      getRecipeDetail(id)
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

      getRecipeDetail(id)
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
    deleteRecipe,
    updateRecipe,
    toggleFavoriteRecipe,
  }
})
