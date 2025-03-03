import { defineStore } from 'pinia'
import { computed, ref } from 'vue'
import { accountApi } from '@/api'
import { useRouter } from 'vue-router'
import { Routes } from '@/shared'
import { push } from 'notivue'
import { modalStore } from '@/stores'

export const useStore = defineStore('account-store', () => {
  const token = ref(localStorage.getItem('token'))
  const router = useRouter()

  const user = ref(null)
  const isLoadingUser = ref(false)

  const isAuth = computed(() => token.value)

  const getUser = async () => {
    if (isAuth.value) {
      isLoadingUser.value = true
      const { data } = await accountApi.getUser()
      user.value = data.user
      isLoadingUser.value = false
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
      push.error(error.response.data.error)
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
      push.error(error.response.data.message)
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

  const changeUsername = async (username) => {
    try {
      const { data } = await accountApi.changeUsername(username)

      push.success(data.message)
      await getUser()
    } catch (error) {
      push.error(error.response.data.message)
    }
  }

  const changeEmail = async (email) => {
    try {
      const { data } = await accountApi.changeEmail(email)

      push.success(data.message)
      await getUser()
    } catch (error) {
      push.error(error.response.data.message)
    }
  }

  const changePassword = async (model) => {
    try {
      const { data } = await accountApi.changePassword(model)

      modalStore.useStore().openModal(null)

      push.success(data.message)
    } catch (error) {
      push.error(error.response.data.error)
    }
  }

  return {
    token,
    isAuth,
    user,
    isLoadingUser,
    login,
    logout,
    register,
    sendEmailCode,
    verifyEmail,
    getUser,
    changeUsername,
    changeEmail,
    changePassword,
  }
})
