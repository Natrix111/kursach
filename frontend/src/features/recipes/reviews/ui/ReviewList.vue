<template>
  <div class="reviews">
    <review-item v-for="review in reviews" :key="review.id" :review="review" />
  </div>
</template>

<script setup>
import { ReviewItem } from '@/features'

defineProps({
  reviews: {
    type: Array,
    required: true,
  },
})
</script>

<style scoped lang="scss">
.reviews {
  @apply space-y-4;
}
</style>
