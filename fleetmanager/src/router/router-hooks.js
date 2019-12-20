// import auth from '@utils/auth.js'
export default function (router) {
  // Before each route evaluates...
  router.beforeEach((to, from, next) => {
    if (!localStorage.getItem('name') && to.path !== '/login') {
      next({ path: '/login' });
    } else if (localStorage.getItem('name') && to.path === '/login') {
      next('/');
    } else {
      next();
    }
  });
}
