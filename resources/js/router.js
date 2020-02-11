import VueRouter from 'vue-router';

import Home from './components/Home';
export default new VueRouter({
  routes: [
    {
      name: 'home',
      path: '/',
      component: Home,
      props: true
    },
    {
      name: 'xls',
      path: '/xls',
      props: true
    },
    {
      name: 'pdf',
      path: '/pdf',
      props: true
    }
  ],
  mode: 'history'
});
