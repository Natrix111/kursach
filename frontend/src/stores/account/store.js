import { defineStore } from 'pinia'
import { computed, ref } from 'vue'
import { accountApi } from '@/api'
import { useRouter } from 'vue-router'
import { Routes } from '@/shared'
import { push } from 'notivue'

export const useStore = defineStore('account-store', () => {
  const token = ref(localStorage.getItem('token'))
  const router = useRouter()

  const user = ref(null)

  const isAuth = computed(() => token.value)

  const getUserData = async () => {
    if (isAuth.value) {
      const { data } = await accountApi.getUser()
      user.value = data.user
    }
  }

  const register = async (model) => {
    try {
      const { data } = await accountApi.register(model)

      token.value = data.token
      localStorage.setItem('token', token.value)

      push.success('Вы успешно зарегистрированы')

      await router.push(`${Routes.auth.defaultPath}/email-confirm`)
    } catch (error) {
      push.error(error.response.data.message)
    }
  }

  const login = async (model) => {
    try {
      const { data } = await accountApi.login(model)

      token.value = data.token
      localStorage.setItem('token', token.value)

      push.success('Вы успешно вошли в профиль')

      await router.push(Routes.home.path)
    } catch (error) {
      push.error(error.response.data.message)
    }
  }

  const logout = () => {
    localStorage.removeItem('token')
    token.value = null

    router.push(Routes.auth.defaultPath)
  }

  const sendEmailCode = async () => {
    try {
      await accountApi.sendEmailCode()
    } catch (error) {
      console.error(error.response.data.message)
    }
  }

  const verifyEmail = async (code) => {
    try {
      const { data } = await accountApi.verifyEmail(code)

      push.success(data.message)

      await router.push(`${Routes.home.path}`)
    } catch (error) {
      push.error(error.response.data.message)
    }
  }

  return { token, isAuth, login, logout, register, sendEmailCode, verifyEmail, user, getUserData }
})
