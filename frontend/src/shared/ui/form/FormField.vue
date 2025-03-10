<template>
  <div class="form-field">
    <label v-if="label" for="input">{{ label }}</label>
    <p v-if="error" class="form-field__error">*{{ error }}</p>
    <textarea
      v-if="type === 'textarea'"
      :placeholder="placeholder"
      v-model="model"
      id="input"
      class="form-field__input"
      :class="{ 'form-field__input--error': error, 'form-field__input--complete': !error && model }"
    />
    <input
      v-else
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
  label: {
    type: String,
    default: '',
  },
})

const model = defineModel()
</script>

<style scoped lang="scss">
.form-field {
  @apply w-full;
  &__error {
    @apply text-xs text-error;
  }

  &__label {
    @apply block text-lg font-bold mb-2;
  }

  &__input {
    @apply px-4 py-2 border-2 border-gray-300 rounded-lg focus:border-primary w-full;

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
