import { defineStore } from 'pinia'
import { ref } from 'vue'

export const useStore = defineStore('password-store', () => {
  const currentModal = ref(null)
  const openModal = (name) => {
    currentModal.value = name
  }

  return { openModal, currentModal }
})
