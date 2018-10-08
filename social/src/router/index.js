import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/home/Home'
<<<<<<< HEAD
import Login from '@/pages/login/Login'
import Cadastro from '@/pages/cadastro/Cadastro'
=======

>>>>>>> parent of b69b0e2... Aulas 12 à 23
Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
<<<<<<< HEAD
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '/cadastrar',
      name: 'cadastro',
      component: Cadastro
=======
>>>>>>> parent of b69b0e2... Aulas 12 à 23
    }
  ]
})
