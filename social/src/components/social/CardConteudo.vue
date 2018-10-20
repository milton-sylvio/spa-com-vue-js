<template>

<div class="row">
    <div class="card">
      <div class="card-content">
        <div class="row valign-wrapper">
          <grid-colunas tamanho="1">
            <img :src="perfil" :alt="nome" class="circle responsive-img"> <!-- notice the "circle" class -->
          </grid-colunas>
          <grid-colunas tamanho="11">
            <span class="black-text">
              <strong>{{nome}}</strong> - <small>{{data}}</small>
            </span>
          </grid-colunas>
        </div>

        <slot />

      </div>
      <div class="card-action">
        <p>
          <i class="material-icons">favorite_border</i>
          <i class="material-icons">insert_comment</i>
        </p>
      </div>
    </div>

</div>

</template>

<script>
import GridColunas from '@/components/layouts/GridColunas'

export default {
  name: 'CardConteudo',
  props: ['perfil', 'nome', 'data'],
  data () {
    return {

    }
  },
  components: {
    GridColunas
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
