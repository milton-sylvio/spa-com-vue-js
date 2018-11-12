<template>
  <div class="mt-50 row">
    <div class="alerts alert-danger" v-show="errors_msg">
      <ul class="errors-list" v-if="validator && Array.isArray(errors)">
        <li v-for="(err, i) in errors" :key="i">{{err}}</li>
      </ul>

      <p v-else>{{errors}}</p>
    </div>

    <div class="card">
      <div class="card-content">
        <h5>O que está acontecendo?</h5>

        <div class="input-field">
          <input type="text" placeholder="Digite aqui o título" v-model="content.title">
          <textarea v-model="content.text" v-if="content.title" placeholder="Digite aqui seu conteúdo" class="materialize-textarea"></textarea>
          <input type="text" v-if="content.title && content.text" placeholder="Digite aqui o link" v-model="content.link">
          <input type="text" v-if="content.title && content.text" placeholder="Digite aqui a URL da imagem" v-model="content.image">
        </div>

        <p class="right-align">
          <button v-if="content.title && content.text" @click="addContent()" class="btn waves-effect waves-light" tamanho="2 offset-s10">Publicar</button>
        </p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'PublicarConteudo',
  props: [],
  data () {
    return {
      errors: '',
      errors_msg: false,
      validator: false,
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
      })
        .then(response => {
          if (response.data.status) {
            console.log(response.data.contents)

            this.content = {
              title: '',
              text: '',
              link: '',
              image: ''
            }

            this.$store.commit('setContentsTimeLine', response.data.contents.data)
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
        .finally(() => {
          this.disabled = ''
        })
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  h5 {
    font-size: 14px;
    margin-top: 0;
  }
</style>
