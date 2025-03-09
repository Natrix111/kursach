<template>
  <teleport to="#modals">
    <transition name="fade">
      <div v-if="currentModal === name" class="app-modal">
        <div class="app-modal__inner" ref="modalEl">
          <slot />
        </div>
      </div>
    </transition>
  </teleport>
</template>

<script setup>
import { modalStore } from '@/stores'
import { storeToRefs } from 'pinia'
import { ref } from 'vue'
import { onClickOutside } from '@vueuse/core'

defineProps({
  name: {
    type: String,
    required: true,
  },
})

const { openModal } = modalStore.useStore()
const { currentModal } = storeToRefs(modalStore.useStore())

const modalEl = ref()

onClickOutside(modalEl, () => openModal(null))
</script>

<style scoped lang="scss">
.app-modal {
  @apply fixed flex justify-center items-center top-0 left-0 right-0 bottom-0 z-20;
  background: rgba(0, 0, 0, 0.2);

  &__inner {
    @apply h-fit;
  }
}
</style>
