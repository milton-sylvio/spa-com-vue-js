<template>
  <span>
    <header>
      <nav-bar logo="Rede Social" url="#/" cor="green darken-3">
        <li>
            <router-link to="/">Home</router-link>
        </li>
        <li>
            <router-link to="/login">Entrar</router-link>
        </li>
        <li>
          <router-link to="/cadastrar">Cadastre-se</router-link>
        </li>
      </nav-bar>
    </header>

    <main>
      <div class="container">
        <div class="row">
          <grid-colunas tamanho="4">
            <slot name="menulateral" />
          </grid-colunas>
          <grid-colunas tamanho="8">
            <slot name="conteudos" />
          </grid-colunas>
        </div>
      </div>
    </main>

    <footer-main cor="green dark-1" logo="Rede Social" descricao="Teste descrição" ano="2018">
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
  }
}
</script>
