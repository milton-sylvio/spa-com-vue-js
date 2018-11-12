import Vue from 'vue'
import Router from 'vue-router'
import Home from '@/pages/home/Home'
import Login from '@/pages/login/Login'
import Cadastro from '@/pages/cadastro/Cadastro'
import Perfil from '@/pages/perfil/Perfil'
import Pagina from '@/pages/pagina/Pagina'
import NaoEncontrado from '@/pages/erros/NaoEncontrado'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/pagina/:id/:nome?',
      name: 'pagina',
      component: Pagina
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
    },
    {
      path: '/perfil',
      name: 'perfil',
      component: Perfil
    },
    {
      path: '/404',
      name: 'nao-encontrado',
      component: NaoEncontrado
    },
    {
      path: '*',
      redirect: '/404'
    }
  ]
})
