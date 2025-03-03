import { api } from '@/shared'

export const login = (model) => api.post('login', model)

export const register = (model) => api.post('register', model)

export const sendEmail = () => api.post('send-email')

export const verifyEmail = (code) => api.post('verify-email', { verification_code: code })

export const getUser = () => api.get('profile')

export const changeAvatar = (model) =>
  api.post('profile/update/avatar', model, {
    headers: {
      'Content-Type': 'multipart/form-data',
    },
  })

export const changeUsername = (username) => api.patch('profile/update/username', { username })

export const changeEmail = (email) => api.patch('profile/update/email', { email })

export const changePassword = (model) =>
  api.patch('profile/change/password', {
    old_password: model.oldPassword,
    new_password: model.password,
  })
