<template>
  <div class="reviews">
    <review-item
      v-for="review in reviews"
      :key="review.id"
      :review="review"
      @delete="deleteReviews"
      @submit="updateReviews"
    />
  </div>
</template>

<script setup>
import { ReviewItem } from '@/features'
import { recipesStore } from '@/stores'

defineProps({
  reviews: {
    type: Array,
    required: true,
  },
})

const { deleteReviews, updateReviews } = recipesStore.useStore()
</script>

<style scoped lang="scss">
.reviews {
  @apply space-y-4;
}
</style>
