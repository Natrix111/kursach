export const Routes = {
  home: {
    path: '/',
    name: 'home',
  },
  auth: {
    path: '/auth',
    defaultPath: '/auth',
    name: 'auth',
    children: {
      login: 'login',
      register: 'register',
      'email-confirm': 'email-confirm',
    },
  },
  profile: {
    path: '/profile',
    name: 'profile',
  },
}
