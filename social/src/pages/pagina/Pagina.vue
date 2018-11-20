<template>
  <site-template>
    <div slot="menuesquerdo">
      <sidebar
        :id="userPage.id"
        :image="userPage.image"
        :name="userPage.name"
        :iduser.sync="userPage.id"
        :profileId="user.id"
        :url="userPage.id + '/' + $slug(userPage.name, {lower: true}, '-')">{{userPage.id}}</sidebar>
    </div>

    <div slot="conteudo" v-scroll="handleScroll">
      <publicar-conteudo />

      <alerts v-if="showAlert" :type="typeAlert" :msg="msgAlert" :showClose="false" />

      <card-conteudo v-for="item in contentList" :key="item.id"
        :profileId="item.id"
        :likes="item.total_likes"
        :likedContent="item.liked_content"
        :comments="item.all_comments"
        :profile="item.user.image"
        :name="item.user.name"
        :userId="item.user.id"
        :date="item.date">
          <card-conteudo-detalhe
            :img="item.image"
            :title="item.title"
            :link="item.link"
            :txt="item.text" />
      </card-conteudo>

      <transition name="fade">
        <preloader v-if="loading" />
      </transition>
    </div>
  </site-template>
</template>

<script>
import SiteTemplate from '@/templates/SiteTemplate'
import Preloader from '@/components/layouts/Preloader'
import CardConteudo from '@/components/social/CardConteudo'
import CardConteudoDetalhe from '@/components/social/CardConteudoDetalhe'
import PublicarConteudo from '@/components/social/PublicarConteudo'

export default {
  name: 'Pagina',
  components: {
    SiteTemplate,
    Preloader,
    CardConteudoDetalhe,
    CardConteudo,
    PublicarConteudo
  },
  data: () => ({
    user: {
      id: '',
      name: '',
      image: '',
      link: '',
      date: ''
    },
    userPage: {
      id: '',
      name: '',
      image: ''
    },
    nextPageUrl: null,
    stopScroll: false,
    loading: true,
    showAlert: false,
    typeAlert: '',
    msgAlert: ''
  }),
  created () {
    let session = this.$store.getters.getUser

    if (session) {
      this.user = session

      this.$http.get(`${this.$api}content/page/${this.$route.params.id}`, {
        'headers': {
          'authorization': `Bearer ${this.$store.getters.getToken}`
        }
      })
        .then(response => {
          this.userPage = response.data.userPage

          console.log('this.userPage.id:', this.userPage.id)

          if (response.data.contents.data.length === 0) {
            this.showAlert = true
            this.typeAlert = 'info'
            this.msgAlert = 'O usuário não tem nenhum conteúdo'
          } else {
            if (response.data.status && this.$route.name === 'pagina') {
              this.$store.commit('setContentsTimeLine', response.data.contents.data)
              this.nextPageUrl = response.data.contents.next_page_url
            }
          }
        })
        .catch(e => {
          console.log('Erros created:', e)
          this.showAlert = true
          this.typeAlert = 'error'
          this.msgAlert = 'Erro no sistema, por favor, tente mais tarde!'
        })
        .finally(() => {
          this.loading = false
        })
    }
  },
  computed: {
    contentList () {
      return this.$store.getters.getContentsTimeLine
    }
  },
  methods: {
    handleScroll () {
      if (this.stopScroll) {
        return
      }

      this.trigger = this.$el.querySelector('.page-footer').clientHeight

      if (window.innerHeight + window.scrollY >= (document.body.offsetHeight - this.trigger)) {
        this.stopScroll = true
        this.loading = true
        this.loadPagination()
      }
    },
    loadPagination () {
      if (this.nextPageUrl) {
        this.$http.get(this.nextPageUrl, {
          'headers': {
            'authorization': `Bearer ${this.$store.getters.getToken}`
          }
        })
          .then(response => {
            if (response.data.status && this.$route.name === 'pagina') {
              this.$store.commit('setPaginationContentsTimeLine', response.data.contents.data)
              this.nextPageUrl = response.data.contents.next_page_url
              this.userPage = response.data.userPage
              this.stopScroll = true
            }
          })
          .catch(e => {
            console.log('Erros:', e)
            this.showAlert = true
            this.typeAlert = 'error'
            this.msgAlert = 'Erro no sistema, por favor, tente mais tarde!'
          })
          .finally(() => {
            this.loading = false
          })
      } else {
        this.loading = false
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
