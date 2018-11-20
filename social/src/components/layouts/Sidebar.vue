<template>
  <aside>
    <div class="card card-user">
      <div class="card-content no-padding center-align">
        <div class="username-dt teal lighten-2">
          <div class="usr-pic">
            <router-link :to="`/pagina/${url}`" class="usr-pic">
              <img :src="image" :alt="name" class="circle responsive-img">
            </router-link>
          </div>
        </div>
        <div class="user-specs">
          <router-link :to="`/pagina/${url}`" class="black-text">
            <h3>{{name}}</h3>
          </router-link>
        </div>
        <div class="section">
          <router-link :to="`/pagina/${url}`" class="waves-effect waves-teal btn-flat">
            Ver Perfil
          </router-link>
        </div>
        <div class="divider"></div>
        <div class="section" v-if="verifyIsShowBtn">
          <button @click="follow()" :id="iduser" class="waves-effect waves-teal btn">
            <i class="material-icons right">thumb_up_alt</i>
            Seguir
          </button>
        </div>
      </div>
    </div>

    <div class="collection with-header">
      <div class="collection-header"><h4>Amigos</h4></div>
      <a href="#!" class="collection-item">Alvin</a>
      <a href="#!" class="collection-item">Fulano</a>
      <a href="#!" class="collection-item">Ciclano</a>
    </div >

  </aside>
</template>

<script>
export default {
  name: 'Sidebar',
  props: ['iduser', 'image', 'name', 'url', 'profileId'],
  data: () => ({
    verifyIsShowBtn: this.iduser
  }),
  watch: {
    iduser: function (val) {
      if (val !== this.profileId) {
        this.verifyIsShowBtn = val
      }
    }
  },
  methods: {
    friend () {
      this.$http.post(`${this.$api}user/friend`, {id: this.iduser}, {
        'headers': {
          'authorization': `Bearer ${this.$store.getters.getToken}`
        }
      })
        .then(response => {
          if (response.data.status) {
            console.log(response.data)
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
    follow () {
      this.friend()
    }
  }
}
</script>

<style lang="scss">
.card-user {
  float: left;
  margin-top: 0;
  width: 100%;
}

.username-dt {
  float: left;
  width: 100%;
  padding-top: 40px;
}

.usr-pic {
  width: 110px;
  height: 110px;
  margin: 0 auto;
  margin-bottom: -48px;

  > img {
      float: none;
      border: 5px solid #fff;
      width: 100%;
  }
}

.user-specs {
  float: left;
  width: 100%;
  padding: 63px 0 27px 0;

  h3 {
    font-size: 24px;
    margin-top: 0;
  }
}
</style>
