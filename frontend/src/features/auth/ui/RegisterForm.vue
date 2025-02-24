<template>
  <form>
    <form-field placeholder="Имя пользователя" v-model="name" :error="errors.name" />
    <form-field placeholder="Email" v-model="email" :error="errors.email" />
    <form-field placeholder="Пароль" v-model="password" :error="errors.password" />
    <button :disabled="!isValid">Войти</button>
  </form>
  {{ errors }}
</template>

<script setup>
import { registerSchema } from '../lib'
import { useForm } from 'vee-validate'
import { computed } from 'vue'
import { FormField } from '@/shared/index.js'

const emit = defineEmits(['submit'])

const { meta, errors, handleSubmit, defineField } = useForm({
  validationSchema: registerSchema,
})

const [name] = defineField('name')
const [email] = defineField('email')
const [password] = defineField('password')

const isValid = computed(() => meta.value.valid)

const submit = handleSubmit((values) => emit('submit', values))
</script>

<style scoped lang="scss"></style>
