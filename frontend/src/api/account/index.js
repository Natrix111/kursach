import { api } from '@/shared'

export const login = (model) => api.post('login', model)

export const register = (model) => api.post('register', model)
