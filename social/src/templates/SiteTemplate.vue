<template>
  <span>
    <header>
      <nav-bar url="/" cor="white orange-text text-darken-2">
        <li v-show="!user">
            <router-link to="/login" class="grey-text">Entrar</router-link>
        </li>
        <li v-show="!user">
          <router-link to="/cadastrar" class="grey-text">Cadastre-se</router-link>
        </li>
        <li v-show="user">
          <router-link to="/perfil" class="grey-text">{{ user.name }}</router-link>
        </li>
        <li v-show="user">
          <a @click="logout()" class="grey-text"><i class="material-icons right">exit_to_app</i>Sair</a>
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

    <footer-main cor="orange darken-2" logo="Rede Social" descricao="Teste descrição" ano="2018">
    </footer-main>
  </span>
</template>

<script>
import NavBar from '@/components/layouts/NavBar'
import FooterMain from '@/components/layouts/FooterMain'

export default {
  name: 'SiteTemplate',
  components: {
    NavBar,
    FooterMain
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
