<template>
    <div class="card">
        <div class="card-content">
            <div class="row valign-wrapper">
                <grid-colunas tamanho="1">
                    <img :src="imgPerfil" :alt="nomePerfil" class="circle responsive-img">
                </grid-colunas>
                <grid-colunas tamanho="11">
                    <span class="black-text">
                        <strong>{{nomePerfil}}</strong> - <small>{{data}}</small>
                    </span>
                </grid-colunas>
            </div>

            <slot />
        </div>

        <div class="card-action">
            <a href="#">
                <i class="material-icons">favorite_border</i>
            </a>
            <a href="#">
                <i class="material-icons">insert_comment</i>
            </a>
        </div>
    </div>
</template>

<script>
import GridColunas from '@/components/layouts/GridColunas'

export default {
  name: 'CardConteudo',
  props: ['imgPerfil', 'nomePerfil', 'data'],
  components: {
    GridColunas
  }
}
</script>
