<template>
    <site-template>
        <div slot="menulateral">
            <card-menu>
                <div class="row valign-wrapper">
                    <grid-colunas tamanho="4">
                        <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle responsive-img">
                    </grid-colunas>
                    <grid-colunas tamanho="8">
                        <span class="black-text">
                            <h4>Maria Silva</h4>
                            Add the "circle" class to it to make it appear circular.
                        </span>
                    </grid-colunas>
                </div>
            </card-menu>
        </div>

        <section slot="conteudos">
          <h2>Perfil</h2>

          <input type="text" placeholder="Nome" v-model="user.name">
          <input type="email" placeholder="E-mail" v-model="user.email">
          <input type="password" placeholder="Senha" v-model="user.password">
          <input type="password" placeholder="Confirme sua senha" v-model="user.password_confirmation">
          <button class="btn" @click="register()">Cadastrar</button>
          <router-link class="waves-effect btn-flat" to="/login">Já tenho cadastro</router-link>
        </section>

        </section>
    </site-template>
</template>

<script>
import CardConteudo from '@/components/social/CardConteudo'
import CardConteudoDetalhe from '@/components/social/CardConteudoDetalhe'
import CardMenu from '@/components/layouts/CardMenu'
import GridColunas from '@/components/layouts/GridColunas'
import PublicarConteudo from '@/components/social/PublicarConteudo'
import SiteTemplate from '@/templates/SiteTemplate'

export default {
  name: 'perfil',
  components: {
    CardConteudo,
    CardConteudoDetalhe,
    CardMenu,
    GridColunas,
    SiteTemplate
  },
  data () {
    return {
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
      axios.post('http://localhost:8000/api/profile', {
        headers: {
          'Access-Control-Allow-Origin': '*',
          'Content-Type': 'application/json'
        },
        name: this.user.name,
        email: this.user.email,
        password: this.user.password,
        password_confirmation: this.user.password_confirmation
      })
        .then(response => {
          if (response.data.token) { // Cadastro com sucesso
            console.log('Cadastro efetuado com sucesso!')
            sessionStorage.setItem('usuario', JSON.stringify(response.data))
            this.$router.push('/')
          } else if (response.data.status === false) { // Cadastro NÃO existente
            console.log('Cadastro não existe!')
            alert('Cadastro inválido!')
          } else { // Erros de validação
            console.log('Contém erros de validação!')
            let erros = ''

            for (let err of Object.values(response.data)) {
              erros += `${err} `
            }

            alert(erros)
          }
        })
        .catch(error => {
          this.errors.push(error)
          console.log(error)
          alert('Tente novamente mais tarde!')
        })

      // console.log('Mah Oooooooooooooieeee')
    }
  }

}
</script>
