<template>
  <site-template>
    <div slot="menuesquerdo">
      <sidebar
        :image="user.image"
        :name="user.name"
        :iduser="user.id"
        :profileId="user.id"
        :url="user.id + '/' + $slug(user.name, {lower: true}, '-')" />
    </div>

    <div slot="conteudo" v-scroll="handleScroll">
      <publicar-conteudo />

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
  name: 'Home',
  components: {
    SiteTemplate,
    Preloader,
    CardConteudoDetalhe,
    CardConteudo,
    PublicarConteudo
  },
  data () {
    return {
      user: {
        id: '',
        name: '',
        image: '',
        link: '',
        date: ''
      },
      nextPageUrl: null,
      stopScroll: false,
      loading: true
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
          if (response.data.status && this.$route.name === 'home') {
            this.$store.commit('setContentsTimeLine', response.data.contents.data)
            this.nextPageUrl = response.data.contents.next_page_url
          }
        })
        .catch(e => {
          console.log('Erros created:', e)
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
            if (response.data.status && this.$route.name === 'home') {
              this.$store.commit('setPaginationContentsTimeLine', response.data.contents.data)
              this.nextPageUrl = response.data.contents.next_page_url
              this.stopScroll = true
            }
          })
          .catch(e => {
            console.log('Erros:', e)
          })
          .finally(() => {
            this.loading = false
          })
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
