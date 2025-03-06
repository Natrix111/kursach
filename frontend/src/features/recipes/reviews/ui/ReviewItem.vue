<template>
  <article class="review">
    <img :src="review.avatar" alt="Аватар" class="review__avatar" />
    <div class="review__content">
      <p class="review__author">{{ review.name }}</p>
      <p class="review__text">{{ review.text }}</p>
    </div>
  </article>
</template>

<script setup>
defineProps({
  review: {
    type: Object,
    required: true,
  },
})
</script>

<style scoped lang="scss">
.review {
  @apply flex gap-4 bg-gray-100 p-4 rounded-lg shadow-sm;

  &__avatar {
    @apply w-12 h-12 rounded-full;
  }

  &__content {
    @apply flex flex-col;
  }

  &__author {
    @apply font-bold text-dark;
  }

  &__text {
    @apply text-gray-700;
  }
}
</style>
