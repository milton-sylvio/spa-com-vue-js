<template>
    <footer :class="'page-footer ' + cor">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">{{logo || 'Social Rede'}}</h5>
                    <p class="grey-text text-lighten-4">{{descricao || 'Aqui vai a sua descrição'}}</p>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <slot></slot>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                &reg; {{ano || '2018'}} Todos os direitos reservados - {{logo || 'Rede Social'}}
                <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
  name: 'FooterMain',
  props: ['logo', 'cor', 'descricao', 'ano']
}
</script>
