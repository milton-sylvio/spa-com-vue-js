<template>
  <span>
    <header>
      <nav-bar logo="Rede Social" url="#" cor="green darken-3" />
    </header>

    <main>
      <router-view />
    </main>

    <footer-main cor="green dark-1" logo="Rede Social" descricao="Teste descrição" ano="2019">
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

export default {
  name: 'app',
  components: {
    NavBar,
    FooterMain
  }
}
</script>
