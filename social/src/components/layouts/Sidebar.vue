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
        <div class="section">
          <button @click="follow(userid)" class="waves-effect waves-teal btn">
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
  props: ['userid', 'image', 'name', 'url'],
  methods: {
    follow (id) {
      console.log('Clicou no follow')
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
