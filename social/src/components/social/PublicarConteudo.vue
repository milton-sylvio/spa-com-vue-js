<template>
  <div class="row">
    <grid-colunas class="input-field" tamanho="12">
      <h5>O que está acontecendo?</h5>

      <input type="text" placeholder="Digite aqui o título" v-model="content.title">
      <textarea v-model="content.text" v-if="content.title" placeholder="Digite aqui seu conteúdo" class="materialize-textarea"></textarea>
      <input type="text" v-if="content.title && content.text" placeholder="Digite aqui o link" v-model="content.link">
      <input type="text" v-if="content.title && content.text" placeholder="Digite aqui a URL da imagem" v-model="content.image">
    </grid-colunas>
    <p class="right-align">
      <button v-if="content.title && content.text" @click="addContent()" class="btn waves-effect waves-light" tamanho="2 offset-s10">Publicar</button>
    </p>
  </div>
</template>

<script>
import GridColunas from '@/components/layouts/GridColunas'

export default {
  name: 'PublicarConteudo',
  components: {
    GridColunas
  },
  props: [],
  data () {
    return {
      content: {
        title: '',
        text: '',
        link: '',
        image: ''
      }
    }
  },
  methods: {
    addContent () {
      this.$http.post(`${this.$api}content/add`, {
        title: this.content.title,
        text: this.content.text,
        link: this.content.link,
        image: this.content.image
      }, {
        'headers': {
          'authorization': `Bearer ${this.$store.getters.getToken}`
        }
      }).then(response => {
        if (response.data) {
          console.log(response.data.contents)
        }
      }).catch(e => {
        console.log(e)
        alert('Tente mais tarde!')
      })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  h5 {
    font-size: 14px;
  }
</style>
