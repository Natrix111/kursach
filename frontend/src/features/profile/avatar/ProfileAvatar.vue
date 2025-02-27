<template>
  <div class="avatar">
    <div class="avatar__container">
      <!--            <img :src="previewImage || avatar" alt="Фото профиля" />-->
      <img src="@/assets/img/profile-image.png" alt="Фото профиля" />
    </div>
    <app-icon name="edit-photo" class="avatar__edit-icon" @click="open" />
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'
// import { profileStore, accountStore } from '@/stores'
import { useFileDialog } from '@vueuse/core'
import { AppIcon } from '@/shared'

const props = defineProps({
  avatar: {
    type: Object,
    required: true,
  },
})

// const { changeAvatar } = profileStore.useStore()
// const { getUserData } = accountStore.useStore()

const previewImage = ref(null)

const { files, open, reset } = useFileDialog({ accept: 'image/*', multiple: false })

// const confirmChange = async () => {
//   isEditing.value = false
//
//   const formData = new FormData()
//   formData.append('avatar', files.value[0])
//
//   try {
//     await changeAvatar(formData)
//   } catch (error) {
//     previewImage.value = null
//   } finally {
//     reset()
//     await getUserData()
//   }
// }

// const cancelChange = () => {
//   reset()
//
//   previewImage.value = null
//   isEditing.value = false
// }

watch(files, (newFiles) => {
  if (newFiles && newFiles.length > 0) {
    const file = newFiles[0]

    const reader = new FileReader()
    reader.onload = () => {
      previewImage.value = reader.result
      isEditing.value = true
    }
    reader.readAsDataURL(file)
  }
})
</script>

<style scoped lang="scss">
.avatar {
  @apply relative w-auto max-w-44 max-h-44;

  &__container {
    @apply relative rounded-[50%] overflow-hidden border border-gray-600;

    img {
      @apply w-full h-full object-cover bg-white text-center;
    }
  }

  &__edit-icon {
    @apply h-6 w-6 absolute bottom-1 right-4 bg-primary p-1 rounded-full overflow-visible text-white;
  }
}
</style>
