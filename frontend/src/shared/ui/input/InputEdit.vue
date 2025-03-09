<template>
  <div class="input-edit">
    <div v-if="!isEdit" class="input-edit__block">
      <span>{{ model }}</span>
      <button @click="editMode" class="input-edit__btn">Изменить</button>
    </div>
    <form v-else @submit.prevent="confirmChange" class="input-edit__block">
      <input ref="inputRef" v-model="newValue" type="text" class="input-edit__input" />
      <button type="submit" class="input-edit__save-btn">Сохранить</button>
      <button type="button" @click="cancelChange" class="input-edit__cancel-btn">Отмена</button>
    </form>
  </div>
</template>

<script setup>
import { nextTick, ref } from 'vue'

const props = defineProps({
  model: {
    type: [String, Number],
    default: null,
  },
})

const emit = defineEmits(['save'])

const isEdit = ref(false)
const newValue = ref(props.model ?? '')
const inputRef = ref(null)

const editMode = () => {
  isEdit.value = !isEdit.value

  nextTick(() => {
    inputRef.value?.focus()
  })
}

const confirmChange = async () => {
  isEdit.value = false

  if (newValue.value && props.model !== newValue.value) emit('save', newValue.value)
  else newValue.value = props.model
}

const cancelChange = () => {
  isEdit.value = false

  newValue.value = props.model
}
</script>

<style scoped lang="scss">
.input-edit {
  &__block {
    @apply flex gap-3;
  }

  &__btn {
    @apply text-sm text-primary hover:text-accent duration-300;
  }

  &__input {
    @apply px-2 py-1 border-2 border-neutral rounded-lg outline-none focus:border-secondary duration-300;
  }

  &__save-btn,
  &__cancel-btn {
    @apply text-sm text-white px-3 py-1 rounded-lg duration-300;
  }

  &__save-btn {
    @apply bg-secondary hover:bg-green-600;
  }

  &__cancel-btn {
    @apply bg-gray-500 hover:bg-gray-600;
  }
}
</style>
