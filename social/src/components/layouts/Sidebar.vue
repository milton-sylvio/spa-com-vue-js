<template>
  <aside>
    <div class="card card-user">
      <div class="card-content no-padding center-align">
        <div class="username-dt orange darken-2">
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
        <slot name="follow" />
      </div>
    </div>

    <h4 class="mt-50 sidebar-title">Seguindo</h4>
    <ul class="collection collection-friends">
      <slot name="friends" />
    </ul >

    <h4 class="mt-50 sidebar-title">Seguidores</h4>
    <ul class="collection collection-friends">
      <slot name="followers" />
    </ul >
  </aside>
</template>

<script>
export default {
  name: 'Sidebar',
  props: ['image', 'name', 'url'],
  data: () => ({
    // verifyIsShowBtn: this.iduser
  }),
  watch: {
    /* iduser: function (val) {
      if (val !== this.profileId) {
        this.verifyIsShowBtn = val
      }
    } */
  },
  methods: {
    friend () {
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
