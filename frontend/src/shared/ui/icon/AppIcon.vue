<template>
  <component :is="SvgComponent" />
</template>

<script setup>
import { defineAsyncComponent } from 'vue'

const props = defineProps({
  name: {
    type: String,
    required: true,
  },
})

const SvgComponent = defineAsyncComponent(() => import(`@/assets/icons/${props.name}.svg`))
</script>
