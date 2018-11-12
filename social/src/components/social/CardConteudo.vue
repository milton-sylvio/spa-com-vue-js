<template>
  <div class="row">
      <div class="card">
        <div class="card-content">
          <div class="row valign-wrapper">
            <grid-colunas tamanho="1">
              <router-link :to="`/pagina/${userId}/${$slug(name, {lower: true}, '-')}`">
                <img :src="profile" :alt="name" class="circle responsive-img">
              </router-link>
            </grid-colunas>
            <grid-colunas tamanho="11">
              <router-link :to="`/pagina/${userId}/${$slug(name, {lower: true}, '-')}`" class="black-text">
                <strong>{{name}}</strong>
                <small>{{date}}</small>
              </router-link>
            </grid-colunas>
          </div>

          <slot />
        </div>

        <div class="card-action">
          <p>
            <a role="button" @click="liked(profileId)">
              <i class="material-icons">{{iconLike}}</i>
              {{countLikes}}
            </a>

            <a role="button" @click="viewComments(profileId)">
              <i class="material-icons">insert_comment</i>
              {{comments.length}}
            </a>
          </p>

          <div v-if="showComments" class="forms right-align">
            <textarea v-model="textComment" placeholder="Digite seu comentário" class="materialize-textarea" minlength="3" maxlength="150"></textarea>
            <button v-if="textComment" @click="comment(profileId)" class="waves-effect waves-light btn-small">
              <i class="material-icons">send</i>
            </button>
          </div>

          <ul class="collection" v-if="comments.length > 0">
            <li class="collection-item avatar" v-for="item in comments" :key="item.id">
              <img :src="item.user.image" alt="" class="circle" />
              <span class="title">
                {{item.user.name}}
                <small>{{item.date}}</small>
              </span>
              <p>{{item.text}}</p>
            </li>
          </ul>
        </div>
      </div>
  </div>
</template>

<script>
export default {
  name: 'CardConteudo',
  props: ['profileId', 'likes', 'likedContent', 'comments', 'profile', 'name', 'date', 'userId'],
  data () {
    return {
      iconLike: this.likedContent ? 'favorite' : 'favorite_border',
      countLikes: this.likes,
      textComment: '',
      errors: '',
      errors_msg: false,
      validator: false,
      showComments: false,
      listComments: this.all_comments || []
    }
  },
  methods: {
    liked (id) {
      this.$http.put(`${this.$api}content/like/${id}`, {}, {
        'headers': {
          'authorization': `Bearer ${this.$store.getters.getToken}`
        }
      })
        .then(response => {
          if (response.data.status) {
            // this.iconLike = this.iconLike === 'favorite_border' ? 'favorite' : 'favorite_border'
            this.$store.commit('setContentsTimeLine', response.data.list.contents.data)
          } else if (response.data.status === false && response.data.validation) {
            // erros de validação
            let error = []

            this.errors = []

            this.errors = Object.values(response.data.errors).forEach(err => {
              return error.push(err + '')
            })

            this.errors = error
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
    viewComments () {
      this.showComments = !this.showComments
    },
    comment (id) {
      this.$http.put(`${this.$api}content/comment/${id}`, {
        text: this.textComment
      }, {
        'headers': {
          'authorization': `Bearer ${this.$store.getters.getToken}`
        }
      })
        .then(response => {
          if (response.data.status) {
            this.$store.commit('setContentsTimeLine', response.data.list.contents.data)
            this.textComment = ''
          } else if (response.data.status === false && response.data.validation) {
            // erros de validação
            let error = []

            this.errors = []

            this.errors = Object.values(response.data.errors).forEach(err => {
              return error.push(err + '')
            })

            this.errors = error
            this.errors_msg = true
            this.validator = true
          }
        })
        .catch(e => {
          console.log('Erros:', e)
          this.errors = 'Erro no sistema! Por favor, tente mais tarde'
          this.errors_msg = true
        })
    }
  }
}
</script>

<style lang="scss">
[role="button"] {
  cursor: pointer;
}

.card {
  .black-text strong {
    display: block;
    line-height: 0.5;
  }
}

.collection-item {
  .avatar {
    .title {
      display: block;
      line-height: 1.25;
      margin-bottom: 15px;

      small {
        display: block;
        font-size: 60%;
        opacity: 0.65;
      }
    }
  }
}

.forms {
  margin-bottom: 25px;
}
</style>
