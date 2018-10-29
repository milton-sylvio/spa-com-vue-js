<template>
  <span>
    <header>
      <nav-bar logo="Rede Social" url="/" cor="teal lighten-2">
        <li v-show="!user">
            <router-link to="/login">Entrar</router-link>
        </li>
        <li v-show="!user">
          <router-link to="/cadastrar">Cadastre-se</router-link>
        </li>
        <li v-show="user">
          <router-link to="/perfil">{{ user.name }}</router-link>
        </li>
        <li v-show="user">
          <a @click="logout()">Sair</a>
        </li>
      </nav-bar>
    </header>

    <main>
      <div class="container">
        <div class="row">
          <grid-colunas tamanho="4">
            <aside class="sidebar-left">
              <slot name="menuesquerdo" />
            </aside>
          </grid-colunas>
          <grid-colunas tamanho="8">
            <slot name="conteudo" />
          </grid-colunas>
        </div>
      </div>
    </main>

    <footer-main cor="teal lighten-2" logo="Rede Social" descricao="Teste descrição" ano="2018">
        <li><a class="grey-text text-lighten-3" href="/">Home</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
    </footer-main>
  </span>
</template>

<script>
import NavBar from '@/components/layouts/NavBar'
import FooterMain from '@/components/layouts/FooterMain'
import GridColunas from '@/components/layouts/GridColunas'

export default {
  name: 'SiteTemplate',
  components: {
    NavBar,
    FooterMain,
    GridColunas
  },
  data () {
    return {
      user: false
    }
  },
  created () {
    let session = this.$store.getters.getUser

    if (session) {
      this.user = session
      // this.user.name = session.name
      // this.user.image = session.image
      // this.user.token = session.token
      // this.$router.push('/')
    } else {
      this.$router.push('/login')
    }
  },
  methods: {
    logout () {
      this.$store.commit('setUser', null)
      sessionStorage.clear()
      this.user = false
      this.$router.push('/login')
    }
  }
}
</script>
