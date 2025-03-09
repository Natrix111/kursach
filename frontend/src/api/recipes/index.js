import { api } from '@/shared'

export const getRecipes = () => api.get('recipes')

export const getRecipeDetail = (id) => api.get(`recipes/${id}`)

export const createRecipe = (model) =>
  api.post('recipes', model, {
    headers: { 'Content-Type': 'multipart/form-data' },
  })

export const deleteRecipe = (id) => api.delete(`recipes/${id}`)

export const updateRecipe = (id) => api.patch(`recipes/${id}`)

export const addToFavoriteRecipe = (id) => api.post(`recipes/favorites/${id}`)

export const deleteFromFavoriteRecipe = (id) => api.delete(`recipes/favorites/${id}`)
