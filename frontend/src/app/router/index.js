import { createRouter, createWebHistory } from 'vue-router'
import { Routes } from '@/shared/index.js'

const routes = [
  {
    name: Routes.home.name,
    path: Routes.home.path,
    component: () => import('@/pages/default-layouts/HomePage.vue'),
  },
  {
    name: Routes.auth.name,
    path: Routes.auth.path,
    defaultPath: Routes.auth.defaultPath,
    component: () => import('@/pages/auth/AuthPage.vue'),
    redirect: `${Routes.auth.defaultPath}/login`,
    children: [
      {
        name: 'login',
        path: 'login',
        component: () => import('@/features/auth/blocks/ui/LoginBlock.vue'),
      },
      {
        name: 'register',
        path: 'register',
        component: () => import('@/features/auth/blocks/ui/RegisterBlock.vue'),
      },
      {
        name: 'email-confirm',
        path: 'email-confirm',
        component: () => import('@/features/auth/blocks/ui/EmailConfirmBlock.vue'),
      },
    ],
  },
  {
    name: Routes.profile.name,
    path: Routes.profile.path,
    component: () => import('@/pages/profile/ProfilePage.vue'),
  },
  {
    name: Routes.recipes.name,
    path: Routes.recipes.path,
    component: () => import('@/pages/recipes/RecipesPage.vue'),
  },
  {
    name: Routes.recipe.name,
    path: Routes.recipe.path,
    component: () => import('@/pages/recipes/RecipePage.vue'),
  },
  {
    name: Routes.recipeCreate.name,
    path: Routes.recipeCreate.path,
    component: () => import('@/pages/recipes/RecipeCreatePage.vue'),
    // beforeEnter: async (to, from, next) => {
    //   const authStore = useAuthStore()
    //   const recipeId = to.params.id
    //
    //   try {
    //     const recipe = await fetchRecipe(recipeId) // Запрашиваем рецепт
    //     if (authStore.user.id === recipe.user_id) {
    //       next() // Разрешаем переход
    //     } else {
    //       next('/') // Если нет прав, редиректим на главную
    //     }
    //   } catch (error) {
    //     next('/') // В случае ошибки редирект
    //   }
    // }
  },
  {
    path: '/:catchAll(.*)',
    redirect: `${Routes.home.path}`,
  },
]

export const router = createRouter({
  history: createWebHistory(),
  routes,
})

// todo middlewares
// router.beforeEach((to, from, next) => {
//   document.title = to.meta.title || 'Хочу помочь'
//
//   const { isAuth } = accountStore.useStore()
//
//   const authRoutes = ['email-confirm', 'profile']
//   const guestRoutes = ['login', 'register', 'recovery', 'email-add', 'email-not-found']
//
//   if (authRoutes.includes(to.name) && !isAuth) {
//     return next(`${Routes.auth.defaultPath}/login`)
//   }
//
//   if (guestRoutes.includes(to.name) && isAuth) {
//     return next(`${Routes.home.path}`)
//   }
//
//   next()
// })
