<template>
  <login-template>
    <aside slot="lateral">
      <img src="https://dhg1h5j42swfq.cloudfront.net/2017/04/04125343/socialmedia-1024x547.jpg" class="responsive-img">
    </aside>

    <section slot="principal">
      <h1>Login</h1>

      <div class="alerts alert-danger" v-show="errors_msg">
        <p v-show="login_fail">{{ msgError }}</p>

        <ul class="errors-list" v-show="validator" v-for="(err, i) in errors" :key="i">
          <li>{{err}}</li>
        </ul>
      </div>

      <div class="input-field">
        <input type="email" id="email" class="validate" v-model="user.email">
        <label for="email">E-mail</label>
      </div>

      <div class="input-field">
        <input type="password" id="password" class="validate" v-model="user.password">
        <label for="password">Senha</label>
      </div>

      <button :class="'btn waves-light ' + disabled" @click="login">
        Entrar
        <i class="material-icons right">send</i>
      </button>
      <router-link class="btn-flat" to="/cadastrar">Cadastre-se</router-link>
    </section>
  </login-template>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'

export default {
  name: 'login',
  components: {
    LoginTemplate
  },
  data () {
    return {
      errors: [],
      errors_msg: false,
      validator: false,
      loading: false,
      login_fail: false,
      msgError: '',
      disabled: '',
      user: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
    login () {
      this.disabled = 'disabled'
      this.errors_msg = false
      this.login_fail = false

      this.$http.post(`${this.$api}login`, {
        email: this.user.email,
        password: this.user.password
      }).then(response => {
        if (response.data.status) {
          // login com sucesso
          console.log('login com sucesso')
          this.$store.commit('setUser', response.data.user)
          sessionStorage.setItem('user', JSON.stringify(response.data.user))
          this.$router.push('/')
        } else if (response.data.status === false && response.data.validation) {
          // erros de validação
          let error = []

          this.errors = Object.values(response.data.errors).forEach(err => {
            return error.push(err + '')
          })

          this.errors = error
          this.errors_msg = true
          this.validator = true
        } else {
          // login inexistente
          this.errors_msg = true
          this.login_fail = true
          this.msgError = 'Login inexistente!'
        }
      }).catch(e => {
        // console.log(this.errors.push(e))
        this.msgError = 'Erro no sistema, por favor, tente mais tarde!'
        this.login_fail = true
        this.errors_msg = true
        this.disabled = ''
      }).finally(() => {
        this.disabled = ''
      })
    }
  }
}
</script>
