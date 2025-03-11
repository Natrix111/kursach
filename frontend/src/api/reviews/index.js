import { api } from '@/shared'

export const createReview = (model) => api.post('reviews', model)

export const deleteReview = (id) => api.delete(`reviews/${id}`)

export const updateReview = (id, model) => api.put(`reviews/${id}`, model)
