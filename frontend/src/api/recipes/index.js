import { api } from '@/shared'

export const getRecipes = () => api.get('recipes')

export const getRecipeDetail = (id) => api.get(`recipes/${id}`)

export const createRecipe = (modal) => api.post('recipes', modal)

export const deleteRecipe = (id) => api.delete(`recipes/${id}`)

export const updateRecipe = (id) => api.patch(`recipes/${id}`)

export const addToFavoriteRecipe = (id) => api.post(`recipes/favorites/${id}`)

export const deleteFromFavoriteRecipe = (id) => api.delete(`recipes/favorites/${id}`)
