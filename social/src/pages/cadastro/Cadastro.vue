<template>
    <login-template>
        <aside slot="lateral">
            <img src="https://dhg1h5j42swfq.cloudfront.net/2017/04/04125343/socialmedia-1024x547.jpg" class="responsive-img">
        </aside>
        <section slot="principal">
          <h2>Cadastro</h2>

          <input type="text" placeholder="Nome" value="">
          <input type="email" placeholder="E-mail" value="">
          <input type="password" placeholder="Senha" value="">
          <input type="password" placeholder="Confirme sua senha" value="">
          <button class="btn">Cadastrar</button>
          <router-link class="waves-effect btn-flat" to="/login">Já tenho cadastro</router-link>
        </section>
    </login-template>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'

export default {
  name: 'cadastro',
  data () {
    return {
    }
  },
  components: {
    LoginTemplate
  }
}
</script>
