<template>
  <site-template>
    <div slot="menuesquerdo">
      <sidebar :image="user.image" :name="user.name" :url="user.id + '/' + $slug(user.name, {lower: true}, '-')">
        <span slot="friends">
          <li v-if="friends.length === 0" href="#!" class="collection-item">Nenhum Usuário</li>
          <li v-else v-for="friend in friends" :key="friend.id" class="collection-item avatar">
            <img :src="friend.image" alt="" class="circle">
            <a :href="'/pagina/' + friend.id + '/' + $slug(friend.name, {lower: true}, '-')">
              <span class="title">{{friend.name}}</span>
            </a>
            <!-- <a href="#!" class="secondary-content disabled orange-text darken-2-text"><i class="material-icons">thumb_up_alt</i></a> -->
          </li>
        </span>

        <span slot="followers">
          <li v-if="followers.length === 0" href="#!" class="collection-item">Nenhum Usuário</li>
          <li v-else v-for="follower in followers" :key="follower.id" class="collection-item avatar">
            <img :src="follower.image" alt="" class="circle">
            <a :href="'/pagina/' + follower.id + '/' + $slug(follower.name, {lower: true}, '-')">
              <span class="title">{{follower.name}}</span>
            </a>
            <!-- <a href="#!" class="secondary-content disabled orange-text darken-2-text"><i class="material-icons">thumb_up_alt</i></a> -->
          </li>
        </span>
      </sidebar>
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
      friends: [],
      followers: [],
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

            this.$http.get(`${this.$api}user/friends-list`, {
              'headers': {
                'authorization': `Bearer ${this.$store.getters.getToken}`
              }
            })
              .then(response => {
                if (response.data.status) {
                  this.friends = response.data.friends
                  this.followers = response.data.followers
                } else {
                  alert(response.data.error)
                }
              })
              .catch(e => {
                console.log('Erros created:', e)
              })
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
              console.log(response.data.contents.data.length)
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
      } else {
        this.loading = false
      }
    }
  }
}
</script>
