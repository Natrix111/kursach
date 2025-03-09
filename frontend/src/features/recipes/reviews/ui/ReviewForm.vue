<template>
  <form v-if="isAuth" class="review-form">
    <textarea class="review-form__textarea" placeholder="Напишите ваш отзыв..."></textarea>
    <button class="review-form__button btn btn--primary">Оставить отзыв</button>
  </form>
  <p v-else class="review-form__message">Войдите, чтобы оставить отзыв.</p>
</template>

<script setup>
import { accountStore } from '@/stores'
import { storeToRefs } from 'pinia'

const { isAuth } = storeToRefs(accountStore.useStore())
</script>

<style scoped lang="scss">
.review-form {
  @apply flex flex-col gap-4 mb-6;

  &__textarea {
    @apply w-full p-4 border rounded-lg shadow-sm resize-none text-gray-700;
  }

  &__button {
    @apply self-end;
  }

  &__message {
    @apply text-gray-500 italic mb-4;
  }
}
</style>
