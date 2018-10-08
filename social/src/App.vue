<template>
  <span>
    <header>
      <nav-bar logo="Rede Social" url="#" cor="green darken-3" />
    </header>

    <main>
      <div class="container">
        <div class="row">
          <grid-colunas tamanho="4">Menu</grid-colunas>
          <grid-colunas tamanho="8">
            <router-view />
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
  name: 'app',
  components: {
    NavBar,
    FooterMain,
    GridColunas
  }
}
</script>
