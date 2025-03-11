<template>
  <div class="avatar">
    <div class="avatar__container">
      <img :src="previewImage || avatar" alt="Фото профиля" />
    </div>
    <app-icon name="edit-photo" class="avatar__edit-icon" @click="open" />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useFileDialog } from '@vueuse/core'
import { AppIcon } from '@/shared'
import { accountApi } from '@/api'
import { changeAvatar } from '@/api/account/index.js'
import { push } from 'notivue'

defineProps({
  avatar: {
    type: Object,
    required: true,
  },
})

const previewImage = ref(null)

const { files, open, onChange } = useFileDialog({ accept: 'image/*', multiple: false })

onChange(async () => {
  if (files.value && files.value.length > 0) {
    const avatar = files.value[0]

    const reader = new FileReader()
    reader.onload = () => {
      previewImage.value = reader.result
    }

    reader.readAsDataURL(avatar)

    const formData = new FormData()
    formData.append('avatar', files.value[0])

    try {
      const { data } = await accountApi.changeAvatar(formData)

      push.success(data.message)
    } catch (error) {
      previewImage.value = null
      push.error(error.response.data.message)
    }
  }
})
</script>

<style scoped lang="scss">
.avatar {
  @apply relative w-auto w-44 h-44;

  &__container {
    @apply relative rounded-[50%] overflow-hidden border border-gray-600 w-full h-full;

    img {
      @apply w-full h-full object-cover bg-white text-center;
    }
  }

  &__edit-icon {
    @apply h-7 w-7 absolute bottom-1 right-5 bg-primary p-1 rounded-full overflow-visible text-white;
  }
}
</style>
