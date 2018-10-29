// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import '@/assets/css/materialize.scss'
import axios from 'axios'
import Vuex from 'vuex'

Vue.use(Vuex)

Vue.config.productionTip = false
Vue.prototype.$http = axios
Vue.prototype.$frontend = 'http://localhost:8080/'
Vue.prototype.$backend = 'http://localhost:8000/'
Vue.prototype.$api = 'http://localhost:8000/api/'

const store = {
  state: {
    user: sessionStorage.getItem('user') ? JSON.parse(sessionStorage.getItem('user')) : null
  },
  getters: {
    getUser: state => {
      return state.user
    },
    getToken: state => {
      return state.user.token
    }
  },
  mutations: {
    setUser (state, n) {
      state.user = n
    }
  }
}

/* eslint-disable no-new */
new Vue({
  el: '#app',
  store: new Vuex.Store(store),
  router,
  render: h => h(App),
  components: { App },
  template: '<App/>'
})
