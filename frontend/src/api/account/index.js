import { api } from '@/shared'

export const login = (model) => api.post('login', model)
