<template>
  <div class="form-field">
    <p v-if="error" class="form-field__error">*{{ error }}</p>
    <input
      :type="type"
      :placeholder="placeholder"
      v-mask="mask"
      v-model="model"
      class="form-field__input"
      :class="{ 'form-field__input--error': error, 'form-field__input--complete': !error && model }"
    />
  </div>
</template>

<script setup>
defineProps({
  type: {
    type: String,
    default: 'text',
  },
  placeholder: {
    type: String,
    default: '',
  },
  error: {
    type: String,
    default: '',
  },
  mask: {
    type: String,
    default: null,
  },
})

const model = defineModel()
</script>

<style scoped lang="scss">
.form-field {
  &__error {
    @apply text-xs text-error;
  }

  &__input {
    @apply px-4 py-2 border-2 border-neutral-dark rounded-lg focus:border-primary w-full;

    &--error {
      @apply border-error;

      &:focus {
        @apply border-error;
      }
    }

    &--complete {
      @apply border-green-600;

      &:focus {
        @apply border-green-600;
      }
    }
  }
}
</style>
