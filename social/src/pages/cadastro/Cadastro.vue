<template>
  <login-template>
    <aside slot="lateral">
      <img src="https://dhg1h5j42swfq.cloudfront.net/2017/04/04125343/socialmedia-1024x547.jpg" class="responsive-img">
    </aside>

    <section slot="principal">
      <h1>Cadastro</h1>

      <div class="alerts alert-danger" v-show="errors_msg">

        <ul class="errors-list" v-show="validator" v-for="(err, i) in errors" :key="i">
          <li>{{err}}</li>
        </ul>
      </div>

      <div class="input-field">
        <input type="text" id="name" v-model="user.name">
        <label for="name">Nome</label>
      </div>
      <div class="input-field">
        <input type="email" id="email" v-model="user.email">
        <label for="">E-mail</label>
      </div>
      <div class="input-field">
        <input type="password" id="passw" v-model="user.password">
        <label for="passw">Senha</label>
      </div>
      <div class="input-field">
        <input type="password" id="password-confirmation " v-model="user.password_confirmation">
        <label for="password-confirmation ">Confirmar senha</label>
      </div>

      <button :class="'btn waves-light ' + disabled" @click="register">
        Cadastrar
        <i class="material-icons right">send</i>
      </button>

      <router-link class="waves-effect btn-flat" to="/login">Já tenho cadastro</router-link>
    </section>
  </login-template>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'

export default {
  name: 'cadastro',
  components: {
    LoginTemplate
  },
  data () {
    return {
      errors: [],
      errors_msg: false,
      validator: false,
      loading: false,
      disabled: '',
      user: {
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      }
    }
  },
  methods: {
    register () {
      this.disabled = 'disabled'
      this.errors_msg = false

      this.$http.post(`${this.$api}register`, {
        name: this.user.name,
        email: this.user.email,
        password: this.user.password,
        password_confirmation: this.user.password_confirmation
      }).then(response => {
        if (response.data.status) {
          // cadastro com sucesso
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
          this.disabled = ''
        } else {
          this.errors = 'Sistema indisponível! Por favor, tente mais tarde!'
          this.errors_msg = true
          this.validator = true
          this.disabled = ''
        }
      }).catch(e => {
        console.log(e)
        this.errors.push(e)
        this.errors_msg = true
        this.disabled = ''
      })
    }
  }
}
</script>
