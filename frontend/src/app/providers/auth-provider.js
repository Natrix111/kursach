import { api, apiStatuses } from '@/shared'
import { accountStore } from '@/entities'

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
    // здесь может быть ваша обработка ошибок в зависимости от статуса ошибки и т.п.
    if (reject.status === apiStatuses.unauthorized) {
      accountStore.useStore().logout()
    }

    return Promise.reject(reject)
  },
)
