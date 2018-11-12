<template>
  <main class="login">
    <div class="row">
      <grid-colunas tamanho="8">
        <section class="login-section">
          <header>
            <h2>Rede Social</h2>
          </header>
        </section>
      </grid-colunas>
      <grid-colunas tamanho="4">
        <div class="login-forms">
          <slot name="principal" />
        </div>
      </grid-colunas>
    </div>
  </main>
</template>

<script>
import GridColunas from '@/components/layouts/GridColunas'

export default {
  name: 'LoginTemplate',
  components: {
    GridColunas
  },
  data () {
    return {
      user: false
    }
  },
  created () {
    let session = this.$store.getters.getUser

    if (session) {
      console.log('tem session')
      this.user = session.name
      this.user.name = session.name
      this.user.image = session.image
      this.user.token = session.token
      this.$router.push('/')
    } else {
      this.$router.push('/login')
    }
  }
}
</script>

<style lang="scss">
body, html {
  height: 100%;
  margin: 0;
}

.row,
.row .col {
  height: 100%;
}

.row,
.login {
  &:after {
    content: "";
    display: table;
    clear: both;
  }
}

.login {
  background-color: #fff;
  height: 100%;
  margin-left: -10px;
  box-sizing: border-box;
  overflow: hidden;
  position: relative;
}

.login-section {
  position: relative;
  background-image: url(../assets/img/social-media.png);
  background-repeat: no-repeat;
  background-position: top center;
  background-size: cover;
  height: 100%;
  object-fit: contain;
  padding: 4.7em 8%;

  header {
    h2 {
      background-color: rgba(255, 255, 255, 0.95);
      display: inline-block;
      padding: 15px 25px;
      text-transform: uppercase;
      width: auto;
    }
  }
}

.login-forms {
  padding: 50px;

  h1 {
    margin-bottom: 50px;
  }
}
</style>
