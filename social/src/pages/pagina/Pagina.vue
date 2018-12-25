<template>
  <site-template>
    <div slot="menuesquerdo">
      <sidebar
        :id="userPage.id"
        :image="userPage.image"
        :name="userPage.name"
        :url="userPage.id + '/' + $slug(userPage.name, {lower: true}, '-')">

        <div slot="follow" class="section">
          <button @click="follow(userPage.id)" :id="userPage.id" v-if="verifyIsShowBtn" class="waves-effect waves-teal orange dark-2 btn">
            <i class="material-icons right">thumb_up_alt</i>
            {{txtBtn}}
          </button>
        </div>

        <span slot="friends">
          <li v-if="friends.length === 0" role="button" class="collection-item">Nenhum Usuário</li>
          <li v-else v-for="friend in friends" :key="friend.id" class="collection-item avatar">
            <img :src="friend.image" :alt="friend.name" class="circle">
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
    txtBtn: '',
    friends: [],
    followers: [],
    friendsOnline: [],
    nextPageUrl: null,
    stopScroll: false,
    loading: true,
    showAlert: false,
    verifyIsShowBtn: false,
    typeAlert: '',
    msgAlert: ''
  }),
  created () {
    this.refreshPage()
  },
  computed: {
    contentList () {
      return this.$store.getters.getContentsTimeLine
    }
  },
  watch: {
    '$route': 'refreshPage'
  },
  methods: {
    refreshPage () {
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

            if (this.user.id !== this.userPage.id) {
              this.verifyIsShowBtn = true
            }

            this.$http.get(`${this.$api}user/friends-list-page/${this.userPage.id}`, {
              'headers': {
                'authorization': `Bearer ${this.$store.getters.getToken}`
              }
            })
              .then(response => {
                if (response.data.status) {
                  this.friends = response.data.friends
                  this.followers = response.data.followers
                  this.friendsOnline = response.data.friendsOnline
                  this.statusFollow()
                } else {
                  alert(response.data.error)
                }
              })
              .catch(e => {
                console.log('Erros created:', e)
              })

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
    statusFollow () {
      for (let friend of this.friendsOnline) {
        if (friend.id === this.userPage.id) {
          this.txtBtn = 'Deixar de seguir'
          return
        }
      }

      this.txtBtn = 'Seguir'
    },
    follow (userid) {
      this.$http.post(`${this.$api}user/friend`, {id: userid}, {
        'headers': {
          'authorization': `Bearer ${this.$store.getters.getToken}`
        }
      })
        .then(response => {
          if (response.data.status) {
            this.friendsOnline = response.data.friends
            this.statusFollow()
          } else {
            // erros de validação
            console.log(response.data.error)
            // let error = []

            // this.errors = []
            // this.errors = Object.values(response.data.errors).forEach(err => {
            //   return error.push(err + '')
            // })

            this.errors = response.data.error
            this.errors_msg = true
            this.validator = true
          }
        })
        .catch(e => {
          console.log('Erros:', e)
          this.errors = 'Erro no sistema! Por favor, tente mais tarde'
          this.errors_msg = true
        })
    },
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
