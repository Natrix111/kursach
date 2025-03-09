<template>
  <div class="recipe__gallery">
    <img :src="activeImage" alt="Изображение рецепта" class="recipe__image" />
    <div class="recipe__thumbnails">
      <img
        v-for="(image, index) in images"
        :key="index"
        :src="image"
        alt="Изображение рецепта"
        class="recipe__thumbnail"
        :class="{ 'recipe__thumbnail--active': activeImage === image }"
        @click="activeImage = image"
      />
    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue'

const props = defineProps({
  images: {
    type: Array,
    required: true,
  },
})

const activeImage = ref(props.images[0])

watch(
  () => props.images,
  (newImages) => {
    activeImage.value = newImages.length > 0 ? newImages[0] : null
  },
  { deep: true },
)
</script>

<style scoped lang="scss">
.recipe {
  &__gallery {
    @apply mb-8;
  }

  &__image {
    @apply w-full h-96 object-contain bg-[#ffffff80] rounded-lg shadow-md p-4;
  }

  &__thumbnails {
    @apply flex gap-4 mt-4 overflow-x-auto;
  }

  &__thumbnail {
    @apply w-24 h-24 object-cover rounded-lg cursor-pointer transition-opacity duration-200;

    &:hover {
      @apply opacity-75;
    }

    &--active {
      @apply border-2 border-primary;
    }
  }
}
</style>
