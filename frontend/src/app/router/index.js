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
        component: () => import('@/features/auth/ui/LoginForm.vue'),
      },
      {
        name: 'register',
        path: 'register',
        component: () => import('@/features/auth/ui/LoginForm.vue'),
      },
    ],
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
