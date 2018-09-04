<template>
    <site-template>
        <div slot="menulateral">
            <card-menu>
                <div class="row valign-wrapper">
                    <grid-colunas tamanho="4">
                        <img src="https://materializecss.com/images/yuna.jpg" alt="" class="circle responsive-img">
                    </grid-colunas>
                    <grid-colunas tamanho="8">
                        <span class="black-text">
                            <h4>Maria Silva</h4>
                            Add the "circle" class to it to make it appear circular.
                        </span>
                    </grid-colunas>
                </div>
            </card-menu>
        </div>

        <section slot="conteudos">
            <publicar-conteudo />

            <card-conteudo
                imgPerfil="https://materializecss.com/images/yuna.jpg"
                nomePerfil="Maria Silva"
                data="02/09/2018 13:30">

                <card-conteudo-detalhe
                    img="https://materializecss.com/images/sample-1.jpg"
                    titulo="Card Title"
                    txt="I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively" />
            </card-conteudo>
        </section>
    </site-template>
</template>

<script>
import CardConteudo from '@/components/social/CardConteudo'
import CardConteudoDetalhe from '@/components/social/CardConteudoDetalhe'
import CardMenu from '@/components/layouts/CardMenu'
import GridColunas from '@/components/layouts/GridColunas'
import PublicarConteudo from '@/components/social/PublicarConteudo'
import SiteTemplate from '@/templates/SiteTemplate'

export default {
  name: 'home',
  data () {
    return {
    }
  },
  components: {
    CardConteudo,
    CardConteudoDetalhe,
    CardMenu,
    GridColunas,
    PublicarConteudo,
    SiteTemplate
  }
}
</script>
