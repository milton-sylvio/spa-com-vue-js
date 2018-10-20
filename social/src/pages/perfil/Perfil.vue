<template>
  <site-template>
    <span slot="menuesquerdo">
      <div class="valign-wrapper center-align">
        <img :src="user.image" :alt="user.name" class="circle img-center z-depth-4 responsive-img"> <!-- notice the "circle" class -->
      </div>
    </span>

    <span slot="conteudo">
      <h2>Perfil</h2>

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
      <div class="file-field input-field">
        <div class="btn">
          <span>Selecionar uma imagem</span>
          <input type="file" @change="previewFile">
        </div>
        <div class="file-path-wrapper">
          <input type="text" class="file-path validate">
        </div>
      </div>
      <div class="input-field">
        <input type="password" id="passw" v-model="user.password">
        <label for="passw">Senha</label>
      </div>
      <div class="input-field">
        <input type="password" id="password-confirmation " v-model="user.password_confirmation">
        <label for="password-confirmation ">Confirmar senha</label>
      </div>

      <button :class="'btn waves-light ' + disabled" @click="profile">
        Atualizar
        <i class="material-icons right">send</i>
      </button>
    </span>
  </site-template>
</template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import CardConteudo from '@/components/social/CardConteudo'
import CardConteudoDetalhe from '@/components/social/CardConteudoDetalhe'
import GridColunas from '@/components/layouts/GridColunas'

export default {
  name: 'Perfil',
  components: {
    SiteTemplate,
    CardConteudo,
    CardConteudoDetalhe,
    GridColunas
  },
  data () {
    return {
      errors: [],
      errors_msg: false,
      validator: false,
      loading: false,
      disabled: '',
      userSession: '',
      user: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        image: ''
      }
    }
  },
  created () {
    let sessionUser = sessionStorage.getItem('user')

    if (sessionUser) {
      this.userSession = JSON.parse(sessionUser)
      this.user.name = this.userSession.name
      this.user.email = this.userSession.email
      this.user.image = this.userSession.image
    } else {
      this.$router.push('/login')
    }
  },
  methods: {
    profile () {
      this.disabled = 'disabled'
      this.errors_msg = false

      this.$http.put(`${this.$api}+profile`, {
        name: this.user.name,
        email: this.user.email,
        image: this.user.image,
        password: this.user.password,
        password_confirmation: this.user.password_confirmation
      }, {'headers': {'authorization': `Bearer ${this.userSession.token}`}})
        .then(response => {
          if (response.data.status) {
            console.log(response.data.user)
            this.user = response.data.user
            sessionStorage.setItem('user', JSON.stringify(this.user))
            alert('Perfil atualizado!')
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
            this.disabled = ''
          }

          this.disabled = ''
        })
        .catch(e => {
          console.log('Erros:', this.errors.push(e))
          this.errors.push(e)
          this.errors_msg = true
          this.disabled = ''
        })
    },
    previewFile (e) {
      let file = e.target.files || e.dataTransfer.files

      if (!file.length) {
        return
      }

      let reader = new FileReader()

      reader.onloadend = (r) => {
        this.user.image = r.target.result
      }

      reader.readAsDataURL(file[0])
    }
  }
}
</script>
