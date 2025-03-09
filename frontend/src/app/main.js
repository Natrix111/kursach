import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { VueMaskDirective } from 'v-mask'

import '@/app/providers/auth-provider.js'

import App from './App.vue'
import { router } from '@/app/router'

import { createNotivue } from 'notivue'

import 'notivue/notification.css'
import 'notivue/animations.css'
import 'notivue/notification-progress.css'

const notivue = createNotivue({
  position: 'top-right',
  limit: 8,
  enqueue: false,
  avoidDuplicates: false,
  notifications: {
    global: {
      duration: 4000,
    },
  },
})

const app = createApp(App)

app.use(createPinia())
app.use(router)
app.directive('mask', VueMaskDirective.bind)
app.use(notivue)

app.mount('#app')
