<template>
  <form @submit.prevent="handleSubmit">
    <div class="recipe-form__field">
      <label for="title" class="recipe-form__label">Название рецепта</label>
      <input
        id="title"
        v-model="formData.title"
        type="text"
        class="recipe-form__input"
        placeholder="Введите название рецепта"
        required
      />
    </div>

    <div class="recipe-form__field">
      <label for="description" class="recipe-form__label">Описание</label>
      <textarea
        id="description"
        v-model="formData.description"
        class="recipe-form__textarea"
        placeholder="Введите описание"
        required
      ></textarea>
    </div>

    <div class="recipe-form__field">
      <label for="ingredients" class="recipe-form__label">Ингредиенты</label>
      <textarea
        id="ingredients"
        v-model="formData.ingredients"
        class="recipe-form__textarea"
        placeholder="Введите ингредиенты, каждый с новой строки"
        required
      ></textarea>
    </div>

    <div class="recipe-form__field">
      <label for="instructions" class="recipe-form__label">Инструкции</label>
      <textarea
        id="instructions"
        v-model="formData.instructions"
        class="recipe-form__textarea"
        placeholder="Введите инструкцию"
        required
      ></textarea>
    </div>

    <div class="recipe-form__field">
      <label for="images" class="recipe-form__label">Изображения</label>
      <input
        type="file"
        id="images"
        @change="handleFileChange"
        class="recipe-form__input"
        accept="image/*"
        multiple
      />
      <div v-if="formData.images.length">
        <p>Выбранные изображения:</p>
        <ul>
          <li v-for="(image, index) in formData.images" :key="index">{{ image.name }}</li>
        </ul>
      </div>
    </div>

    <button type="submit" class="recipe-form__submit-button">
      {{ isEdit ? 'Сохранить' : 'Создать' }}
    </button>
  </form>
</template>

<script setup>
import { ref } from 'vue'

// Пропсы для переданных данных рецепта (если редактируем)
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
})

const formData = ref({ ...props.recipe })

const handleSubmit = () => {
  // Отправка данных на сервер
  console.log('Данные формы:', formData.value)
}

const handleFileChange = (event) => {
  const files = event.target.files
  if (files.length) {
    formData.value.images = Array.from(files)
  }
}
</script>

<style scoped lang="scss">
.recipe-form {
  @apply bg-white p-6 rounded-lg shadow-md;

  &__field {
    @apply mb-6;
  }

  &__label {
    @apply block text-lg font-bold mb-2;
  }

  &__input,
  &__textarea {
    @apply w-full p-2 border border-gray-300 rounded-md;
  }

  &__textarea {
    @apply h-40 resize-none;
  }

  &__submit-button {
    @apply py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600;
  }
}
</style>
