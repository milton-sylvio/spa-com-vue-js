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

      <card-conteudo v-for="item in contentList" :key="item.id"
        :profileId="item.id"
        :likes="item.total_likes"
        :likedContent="item.liked_content"
        :profile="item.user.image"
        :name="item.user.name"
        :date="item.date">
          <card-conteudo-detalhe
            :img="item.image"
            :title="item.title"
            :link="item.link"
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
        image: '',
        link: '',
        date: ''
      }
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
            this.$store.commit('setContentsTimeLine', response.data.contents.data)
          }
        })
        .catch(e => {
          console.log('Erros:', e)
        })
        .finally(() => {
        })
    }
  },
  computed: {
    contentList () {
      return this.$store.getters.getContentsTimeLine
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
