<template>

<div class="row">
    <div class="card">
      <div class="card-content">
        <div class="row valign-wrapper">
          <grid-colunas tamanho="1">
            <img :src="profile" :alt="name" class="circle responsive-img"> <!-- notice the "circle" class -->
          </grid-colunas>
          <grid-colunas tamanho="11">
            <span class="black-text">
              <strong>{{name}}</strong>
              <small>{{formatDate(date)}}</small>
            </span>
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

          <i class="material-icons">insert_comment</i>
        </p>
      </div>
    </div>

</div>

</template>

<script>
import GridColunas from '@/components/layouts/GridColunas'

export default {
  name: 'CardConteudo',
  props: ['profileId', 'likes', 'likedContent', 'profile', 'name', 'date'],
  components: {
    GridColunas
  },
  data () {
    return {
      iconLike: this.likedContent ? 'favorite' : 'favorite_border',
      countLikes: this.likes,
      errors: '',
      errors_msg: false,
      validator: false
    }
  },
  methods: {
    liked (profileId) {
      this.$http.put(`${this.$api}content/like/${profileId}`, {}, {
        'headers': {
          'authorization': `Bearer ${this.$store.getters.getToken}`
        }
      })
        .then(response => {
          if (response.data.status) {
            this.iconLike = this.iconLike === 'favorite_border' ? 'favorite' : 'favorite_border'

            this.countLikes = response.data.likes
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
    formatDate (date) {
      let dh = date.split(' ')
      let day = dh[0]

      day = day.split('-')
      day = `${day[2]}/${day[1]}/${day[0]}`

      let hour = dh[1]

      hour = hour.split(':')
      hour = `${hour[0]}:${hour[1]}`

      return `${day} - ${hour}`
    }
  }
}
</script>

<style scoped>
  .card {
    background-color: #f3f3f3;
  }

  .card .black-text  strong {
    display: block;
    line-height: 0.5;
  }

  [role="button"] {
    cursor: pointer;
  }
</style>
