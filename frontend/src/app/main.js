import { createApp } from 'vue'
import { createPinia } from 'pinia'
import { VueMaskDirective } from 'v-mask'

import '@/app/providers/auth-provider.js'

import App from './App.vue'
import { router } from '@/app/router'

const app = createApp(App)

app.use(createPinia())
app.use(router)
app.directive('mask', VueMaskDirective.bind)

app.mount('#app')
