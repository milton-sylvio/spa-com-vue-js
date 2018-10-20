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

      <card-conteudo
        :perfil="user.image"
        :nome="user.name"
        data="13/01/18 13:30">
          <card-conteudo-detalhe
            img="http://materializecss.com/images/sample-1.jpg"
            titulo=""
            txt="I am a very simple card. I am good at containing small bits of information.
            I am convenient because I require little markup to use effectively."  />
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
      }
    }
  },
  created () {
    let session = sessionStorage.getItem('user')
    let userSession = false

    if (session) {
      userSession = JSON.parse(session)
      this.user.name = userSession.name
      this.user.image = userSession.image
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
