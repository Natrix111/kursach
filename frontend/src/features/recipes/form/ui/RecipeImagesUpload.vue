<template>
  <div
    class="image-uploader"
    @dragover.prevent="dragActive = true"
    @dragleave.prevent="dragActive = false"
    @drop.prevent="handleDrop"
  >
    <div
      class="image-uploader__input"
      :class="{ 'image-uploader__input--active': dragActive }"
      @click="open"
    >
      <p class="image-uploader__text">Нажмите или перетащите файлы (1-5 изображений, макс. 2MB)</p>
    </div>

    <p v-if="error" class="image-uploader__error">{{ error }}</p>

    <div v-if="imagePreviews.length" class="image-uploader__preview">
      <div v-for="(image, index) in imagePreviews" :key="index" class="image-uploader__item">
        <img :src="image.preview" :alt="image.file.name" class="image-uploader__img" />
        <p class="image-uploader__name">{{ image.file.name }}</p>
        <button type="button" class="image-uploader__remove" @click="removeImage(index)">
          Удалить
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { useFileDialog } from '@vueuse/core'

const emit = defineEmits(['upload'])

const MAX_FILES = 5
const MAX_SIZE_MB = 2

const imagePreviews = ref([])
const error = ref('')
const dragActive = ref(false)

const { open, onChange, reset } = useFileDialog({
  accept: 'image/*',
  multiple: true,
})

const processFiles = (newFiles) => {
  if (!newFiles || newFiles.length === 0) return
  error.value = ''

  if (newFiles.length + imagePreviews.value.length > MAX_FILES) {
    error.value = `Можно загрузить максимум ${MAX_FILES} изображений`
    return
  }

  for (const file of newFiles) {
    if (file.size > MAX_SIZE_MB * 1024 * 1024) {
      error.value = `Файл ${file.name} превышает ${MAX_SIZE_MB}MB`
      return
    }

    const reader = new FileReader()
    reader.onload = (e) => {
      imagePreviews.value.push({ file, preview: e.target.result })

      emit(
        'upload',
        imagePreviews.value.map((item) => item.file),
      )
    }
    reader.readAsDataURL(file)
  }

  reset()
}

onChange(processFiles)

const handleDrop = (event) => {
  dragActive.value = false
  const droppedFiles = event.dataTransfer.files
  processFiles(droppedFiles)
}

const removeImage = (index) => {
  imagePreviews.value.splice(index, 1)
}
</script>

<style scoped lang="scss">
.image-uploader {
  @apply flex flex-col gap-4 w-full max-w-md mx-auto;

  &__input {
    @apply flex items-center justify-center w-full p-4 border-2 border-dashed border-gray-400 rounded-lg cursor-pointer transition;

    &--active {
      @apply border-primary bg-gray-100;
    }
  }

  &__text {
    @apply text-gray-500 text-center text-sm;
  }

  &__error {
    @apply text-red-500 text-sm;
  }

  &__preview {
    @apply grid grid-cols-2 gap-3;
  }

  &__item {
    @apply flex flex-col items-center gap-2 p-2 border rounded-lg shadow bg-white relative;
  }

  &__img {
    @apply w-24 h-24 object-cover rounded-lg;
  }

  &__name {
    @apply text-xs text-center truncate w-full px-2;
  }

  &__remove {
    @apply text-red-500 hover:text-red-700 text-xs mt-1;
  }
}
</style>
