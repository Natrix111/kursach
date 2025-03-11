<template>
  <article class="review">
    <img :src="review.user.avatar" alt="Аватар" class="review__avatar" />
    <div class="review__content">
      <p class="review__author">{{ review.user.username }}</p>
      <div
        class="review__text"
        :contenteditable="isEditing"
        @blur.stop="saveEdit"
        @input="updateText"
        ref="editableText"
      >
        {{ editedText }}
      </div>
    </div>

    <div v-if="review.can_edit" class="review__actions">
      <app-icon
        v-if="!isEditing"
        name="edit"
        @click="enableEdit"
        class="review__action-icon review__action-icon-edit"
      />
      <app-icon
        v-else
        name="check"
        @click="saveEdit"
        class="review__action-icon review__action-icon-save"
      />
      <app-icon
        name="trash"
        @click="emit('delete', review.id)"
        class="review__action-icon review__action-icon-trash"
      />
    </div>
  </article>
</template>

<script setup>
import { ref, nextTick } from 'vue'
import { AppIcon } from '@/shared'

const props = defineProps({
  review: {
    type: Object,
    required: true,
  },
})

const emit = defineEmits(['submit', 'delete'])

const isEditing = ref(false)
const editedText = ref(props.review.comment)
const editableText = ref(null)

const enableEdit = () => {
  isEditing.value = true
  nextTick(() => {
    editableText.value.focus()
  })
}

const updateText = (event) => {
  editedText.value = event.target.innerText
}

const saveEdit = () => {
  if (editedText.value.trim() !== props.review.comment.trim()) {
    emit('submit', props.review.id, editedText.value.trim()) // Отправляем обновленный комментарий
  }
  isEditing.value = false
}
</script>

<style scoped lang="scss">
.review {
  @apply flex gap-4 bg-gray-100 p-4 rounded-lg shadow-sm relative;

  &__avatar {
    @apply w-12 h-12 rounded-full;
  }

  &__content {
    @apply flex flex-col flex-grow;
  }

  &__author {
    @apply font-bold text-dark;
  }

  &__text {
    @apply text-gray-700 cursor-text;
    outline: none;

    &:focus {
      @apply bg-gray-200 px-1;
    }
  }

  &__actions {
    @apply flex items-center gap-2 absolute top-2 right-2;
  }

  &__action-icon {
    @apply text-gray-900 hover:text-gray-900 transition h-5;

    &-edit {
      @apply hover:text-primary;
    }

    &-save {
      @apply hover:text-green-600;
    }

    &-trash {
      @apply hover:text-error;
    }
  }
}
</style>
