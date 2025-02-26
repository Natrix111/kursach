import { api } from '@/shared'

export const login = (model) => api.post('login', model)

export const register = (model) => api.post('register', model)

export const sendEmail = () => api.post('send-email')

export const verifyEmail = (code) => api.post('verify-email', { verification_code: code })
