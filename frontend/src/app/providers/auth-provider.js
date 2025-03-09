import { api } from '@/shared'
import { accountStore } from '@/stores'

/**
 * `Interceptors` - позволяет перехватывать запрос api,
 * `interceptors.request` - отправка запроса,
 * `interceptors.response` - ответ с запроса
 * */
api.interceptors.request.use((config) => {
  const token = localStorage.getItem('token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
})

api.interceptors.response.use(
  (response) => response,
  (reject) => {
    if (reject.status === 401) {
      accountStore.useStore().logout()
    }

    return Promise.reject(reject)
  },
)
