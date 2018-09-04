<template>
    <login-template>
        <aside slot="lateral">
            <img src="https://dhg1h5j42swfq.cloudfront.net/2017/04/04125343/socialmedia-1024x547.jpg" class="responsive-img">
        </aside>
        <section slot="principal">
            <div v-if="cadastro">
                <h2>Cadastro</h2>

                <input type="text" placeholder="Nome" value="">
                <input type="email" placeholder="E-mail" value="">
                <input type="password" placeholder="Senha" value="">
                <input type="password" placeholder="Confirme sua senha" value="">
                <button class="btn">Cadastrar</button>
                <button class="waves-effect waves-teal btn-flat" @click="cadastro = false">Já tenho cadastro</button>
            </div>
            <div v-else>
                <h2>Login</h2>

                <input type="email" placeholder="E-mail" value="">
                <input type="password" placeholder="Senha" value="">
                <button class="btn">Entrar</button>
                <button class="waves-effect waves-teal btn-flat" @click="cadastro = true">Cadastre-se</button>
            </div>
        </section>
    </login-template>
</template>

<script>
import LoginTemplate from '@/templates/LoginTemplate'

export default {
  name: 'login',
  data () {
    return {
      cadastro: false
    }
  },
  components: {
    LoginTemplate
  }
}
</script>
