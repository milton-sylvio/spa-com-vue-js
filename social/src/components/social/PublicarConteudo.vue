<template>
  <div class="row">
    <grid-colunas class="input-field" tamanho="12">
      <textarea v-model="conteudo" class="materialize-textarea"></textarea>
      <label>O que está acontecendo?</label>
    </grid-colunas>
    <p>
      <grid-vue v-if="conteudo" class="btn waves-effect waves-light" tamanho="2 offset-s10">Publicar</grid-vue>
    </p>
  </div>
</template>

<script>
import GridColunas from '@/components/layouts/GridColunas'

export default {
  name: 'PublicarConteudo',
  props: [],
  data () {
    return {
      conteudo: ''
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
