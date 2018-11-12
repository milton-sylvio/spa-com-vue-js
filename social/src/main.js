// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import '@/assets/css/materialize.scss'
import axios from 'axios'
import Vuex from 'vuex'
import slug from 'slug'
import GridColunas from '@/components/layouts/GridColunas'
import Alerts from './components/layouts/Alerts'
import Sidebar from './components/layouts/Sidebar'

Vue.use(Vuex)
// Vue.use(slug)

Vue.config.productionTip = false
Vue.prototype.$http = axios
Vue.prototype.$frontend = 'http://localhost:8080/'
Vue.prototype.$api = 'http://localhost:8000/api/'
Vue.prototype.$slug = slug

Vue.component('alerts', Alerts)
Vue.component('sidebar', Sidebar)
Vue.component('grid-colunas', GridColunas)

const store = {
  state: {
    user: sessionStorage.getItem('user') ? JSON.parse(sessionStorage.getItem('user')) : null,
    contentsTimeLine: []
  },
  getters: {
    getUser: state => {
      return state.user
    },
    getToken: state => {
      return state.user.token
    },
    getContentsTimeLine: state => {
      return state.contentsTimeLine
    }
  },
  mutations: {
    setUser (state, n) {
      state.user = n
    },
    setContentsTimeLine (state, n) {
      state.contentsTimeLine = n
    },
    setPaginationContentsTimeLine (state, list) {
      for (let item of list) {
        state.contentsTimeLine.push(item)
      }
    }
  }
}

Vue.directive('scroll', {
  inserted: function (el, binding) {
    let f = function (evt) {
      if (binding.value(evt, el)) {
        window.removeEventListener('scroll', f)
      }
    }
    window.addEventListener('scroll', f)
  }
})

router.beforeEach((to, from, next) => {
  if (!to.matched.length) {
    next('/404')
  } else {
    next()
  }
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  store: new Vuex.Store(store),
  router,
  render: h => h(App),
  components: { App },
  template: '<App/>'
})
