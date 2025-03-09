<template>
  <app-modal name="profile-password">
    <div class="profile-password">
      <app-icon name="cross" class="profile-password__cross" @click="openModal(null)" />
      <div class="profile-password__inner">
        <h2 class="profile-password__title">Изменить пароль</h2>
        <form @submit.prevent="submit" class="profile-password__form">
          <form-field
            placeholder="Старый пароль"
            type="password"
            :error="errors.oldPassword"
            v-model="oldPassword"
          />
          <form-field
            placeholder="Новый пароль"
            type="password"
            :error="errors.password"
            v-model="password"
          />
          <form-field
            placeholder="Подтверждение нового пароля"
            type="password"
            :error="errors.passwordConfirm"
            v-model="passwordConfirm"
          />
          <button class="profile-password__btn btn btn--primary" :disabled="!isValid">
            Сохранить
          </button>
        </form>
      </div>
    </div>
  </app-modal>
</template>

<script setup>
import { AppModal, modalStore, accountStore } from '@/stores'
import { AppIcon, FormField } from '@/shared'
import { useForm } from 'vee-validate'
import { passwordSchema } from '../lib'
import { computed } from 'vue'

const { openModal } = modalStore.useStore()
const { changePassword } = accountStore.useStore()

const { handleSubmit, defineField, meta, errors } = useForm({
  validationSchema: passwordSchema,
})

const [password] = defineField('password')
const [passwordConfirm] = defineField('passwordConfirm')
const [oldPassword] = defineField('oldPassword')

const isValid = computed(() => meta.value.valid)

const submit = handleSubmit((values) => changePassword(values))
</script>

<style scoped lang="scss">
.profile-password {
  @apply rounded-2xl py-36 px-36 relative items-center bg-white;

  &__cross {
    @apply absolute top-9 right-9 cursor-pointer h-5 w-5 text-gray-600;
  }

  &__inner {
    @apply w-[20.5rem] flex flex-col gap-12;
  }

  &__title {
    @apply text-[2.5rem]/none text-gray-700 text-center;
  }

  &__form {
    @apply flex flex-col gap-5 items-center w-full;
  }

  &__btn {
    @apply w-full;
  }
}
</style>
