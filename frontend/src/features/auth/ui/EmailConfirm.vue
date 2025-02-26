<template>
  <div class="confirm-email">
    <div class="confirm-email__top">
      <h2 class="confirm-email__title">Подтвердите электронную почту</h2>
      <p class="confirm-email__description">На почту отправлен код подтверждения</p>
    </div>
    <div class="confirm-email__bottom">
      <form class="confirm-email__form" @submit.prevent="submit">
        <form-field
          mask="######"
          v-model="code"
          placeholder="123456"
          class="confirm-email__field"
        />
        <button class="confirm-email__button btn btn--primary">Отправить</button>
      </form>
      <p class="confirm-email__timer" v-if="time > 0">
        Вы сможете отправить код повторно через {{ timer }}
      </p>
      <p class="confirm-email__resend" @click="startTimer" v-else>Отправить код повторно</p>
    </div>
  </div>
</template>

<script setup>
import { computed, onMounted, onUnmounted, ref } from 'vue'
import { FormField } from '@/shared'
import { accountApi } from '@/api'

let interval = null

const time = ref(90)
const timer = computed(() => formatTime(time.value))

const code = ref(null)

const submit = () =>
  code.value && code.value.length === 6 ? accountApi.verifyEmail(code.value) : null

const formatTime = (seconds) => {
  const minutes = Math.floor(seconds / 60)
  const remainingSeconds = seconds % 60
  return `${String(minutes)}:${String(remainingSeconds).padStart(2, '0')}`
}

const startTimer = () => {
  accountApi.sendEmail()

  time.value = 10
  interval = setInterval(() => {
    if (time.value > 0) {
      time.value--
      if (time.value === 0) clearInterval(interval)
    } else {
      clearInterval(interval)
    }
  }, 1000)
}

onMounted(() => startTimer())
onUnmounted(() => clearInterval(interval))
</script>

<style scoped lang="scss">
.confirm-email {
  @apply flex flex-col items-center gap-8 w-full;

  &__top,
  &__bottom {
    @apply flex flex-col gap-5 items-center text-center w-full;
  }

  &__title {
    @apply text-[2.5rem]/none;
  }

  &__description {
    @apply font-light;
  }

  &__form {
    @apply w-full flex flex-col items-center;
  }

  &__button {
    @apply w-full mt-4;
  }

  &__field {
    @apply text-center w-2/3;
  }

  &__timer {
    @apply text-gray-500;
  }

  &__resend {
    @apply underline cursor-pointer text-primary;
  }
}
</style>
