<template>
  <site-template>
    <span slot="menuesquerdo">
      <div class="row valign-wrapper">
        <grid-colunas tamanho="4">
          <img :src="user.image" :alt="user.name" class="circle responsive-img"> <!-- notice the "circle" class -->
        </grid-colunas>
        <grid-colunas tamanho="8">
          <span class="black-text">
            <h5>{{user.name}}</h5>
          </span>
        </grid-colunas>
      </div>
    </span>

    <span slot="conteudo">
      <publicar-conteudo />

      <card-conteudo v-for="item in contents" :key="item.id"
        :perfil="item.user.image"
        :nome="item.user.name"
        :data="item.user.date">
          <card-conteudo-detalhe
            :img="item.image"
            :titulo="item.title"
            :txt="item.text" />
      </card-conteudo>
    </span>
  </site-template>
</template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import GridColunas from '@/components/layouts/GridColunas'
import CardConteudo from '@/components/social/CardConteudo'
import CardConteudoDetalhe from '@/components/social/CardConteudoDetalhe'
import PublicarConteudo from '@/components/social/PublicarConteudo'

export default {
  name: 'Home',
  components: {
    SiteTemplate,
    GridColunas,
    CardConteudoDetalhe,
    CardConteudo,
    PublicarConteudo
  },
  data () {
    return {
      user: {
        name: '',
        image: ''
      },
      contents: []
    }
  },
  created () {
    let session = this.$store.getters.getUser

    if (session) {
      this.user = session

      this.$http.get(`${this.$api}content/list`, {
        'headers': {
          'authorization': `Bearer ${this.$store.getters.getToken}`
        }
      })
        .then(response => {
          console.log(response)

          if (response.data.status) {
            this.contents = response.data.contents.data
          }
        })
        .catch(e => {
          console.log('Erros:', e)
        })
        .finally(() => {
        })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
