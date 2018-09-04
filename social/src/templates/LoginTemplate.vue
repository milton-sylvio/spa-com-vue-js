<template>
  <!-- <span> -->
    <!-- <header>
      <nav-bar logo="Rede Social" url="#" cor="green darken-3" />
    </header> -->

    <main>
      <!-- <div class="container"> -->
        <div class="row">
          <grid-colunas tamanho="9">
              <slot name="lateral" />
          </grid-colunas>
          <grid-colunas tamanho="3">
            <slot name="principal" />
          </grid-colunas>
        </div>
      <!-- </div> -->
    </main>

    <!-- <footer-main cor="green dark-1" logo="Rede Social" descricao="Teste descrição" ano="2018">
        <li><a class="grey-text text-lighten-3" href="/">Home</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
        <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
    </footer-main> -->
  <!-- </span> -->
</template>

<script>
import NavBar from '@/components/layouts/NavBar'
import FooterMain from '@/components/layouts/FooterMain'
import GridColunas from '@/components/layouts/GridColunas'
import CardMenu from '@/components/layouts/CardMenu'

export default {
  name: 'LoginTemplate',
  components: {
    NavBar,
    FooterMain,
    GridColunas,
    CardMenu
  }
}
</script>
