<template>
    <footer ref="footerMain" :class="'page-footer ' + cor">
        <div class="container center-align">
            {{ano || '2018'}} &reg; Todos os direitos reservados - {{$store.getters.getProject}}
        </div>
    </footer>
</template>

<script>
export default {
  name: 'FooterMain',
  props: ['logo', 'cor', 'descricao', 'ano']
}
</script>

<style lang="scss">
.page-footer {
    padding-bottom: 20px;
}
</style>
