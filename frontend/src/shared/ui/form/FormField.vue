<template>
  <div class="form-field">
    <p v-if="error" class="form-field__error">*{{ error }}</p>
    <input
      :type="type"
      :placeholder="placeholder"
      v-mask="mask"
      v-model="model"
      class="form-field__input"
    />
  </div>
</template>

<script setup>
const props = defineProps({
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
  }

  &__input {
    @apply px-4 py-2 border-2 border-neutral rounded-lg focus:outline-none focus:border-secondary w-full;
  }
}
</style>
