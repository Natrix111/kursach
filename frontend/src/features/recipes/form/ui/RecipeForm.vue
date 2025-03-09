<template>
  <form class="recipe-form" @submit.prevent="submit">
    <form-field
      label="Название рецепта"
      v-model="title"
      :error="errors.title"
      placeholder="Введите название рецепта"
    />

    <form-field
      label="Описание"
      v-model="description"
      :error="errors.description"
      placeholder="Введите описание"
      type="textarea"
    />

    <form-field
      label="Ингредиенты"
      v-model="ingredients"
      :error="errors.ingredients"
      placeholder="Введите ингредиенты, каждый с новой строки"
      type="textarea"
    />

    <form-field
      label="Инструкции"
      v-model="instructions"
      :error="errors.instructions"
      placeholder="Введите инструкцию"
      type="textarea"
    />

    <recipe-images-upload @upload="uploadImages" />

    <button :disabled="!isValid" class="recipe-form__submit-button btn btn--primary">
      {{ isEdit ? 'Сохранить' : 'Создать' }}
    </button>
  </form>
</template>

<script setup>
import { useForm } from 'vee-validate'
import { computed, ref, watch } from 'vue'
import { FormField } from '@/shared'
import { recipeSchema } from '../lib'
import { RecipeImagesUpload } from '@/features/index.js'
import { login } from '@/api/account/index.js'

const props = defineProps({
  recipe: {
    type: Object,
    required: false,
    default: () => ({
      title: '',
      description: '',
      ingredients: '',
      instructions: '',
      images: [],
    }),
  },
  serverErrors: {
    type: Object,
    default: () => ({}),
  },
})

const emit = defineEmits(['submit'])

const { meta, errors, handleSubmit, defineField, setErrors } = useForm({
  validationSchema: recipeSchema,
  initialValues: props.recipe,
})

const images = ref([])

const [title] = defineField('title')
const [description] = defineField('description')
const [ingredients] = defineField('ingredients')
const [instructions] = defineField('instructions')

const isEdit = computed(() => !!props.recipe.title)
const isValid = computed(() => meta.value.valid)

//
// watch(
//   () => props.recipe,
//   (newRecipe) => {
//     setValues(newRecipe)
//   },
//   { deep: true },
// )

const uploadImages = (newImages) => {
  images.value = newImages
}

const submit = handleSubmit((values) => emit('submit', { ...values, images: images.value }))

watch(
  () => props.serverErrors,
  (newErrors) => {
    console.log(newErrors)
    if (Object.keys(newErrors).length) {
      setErrors({
        title: newErrors.title?.[0] || '',
        description: newErrors.description?.[0] || '',
        ingredients: newErrors.ingredients?.[0] || '',
        instructions: newErrors.instructions?.[0] || '',
        images: newErrors.images?.[0] || '',
      })
    }
  },
)
</script>

<style scoped lang="scss">
.recipe-form {
  @apply flex flex-col gap-4;

  &__submit-button {
    @apply mt-4;
  }
}
</style>
