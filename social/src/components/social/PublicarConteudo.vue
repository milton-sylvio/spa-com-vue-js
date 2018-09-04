<template>
    <div class="row">
        <grid-colunas class="input-field" tamanho="12">
            <textarea v-model="conteudo" id="conteudoID" class="materialize-textarea"></textarea>
            <label for="conteudoID">O que está acontecendo?</label>
        </grid-colunas>
        <grid-colunas v-if="conteudo" class="btn waves-effect waves-light" tamanho="2 offset-s10">Publicar</grid-colunas>
    </div>
</template>

<script>
import GridColunas from '@/components/layouts/GridColunas'

export default {
  name: 'PublicarConteudo',
  props: [],
  components: {
    GridColunas
  },
  data () {
    return {
      conteudo: ''
    }
  }
}
</script>
