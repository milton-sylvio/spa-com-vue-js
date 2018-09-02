<template>
    <div :class="'col s' + tamanho">
        <slot></slot>
    </div>
</template>

<script>
export default {
  name: 'grid-colunas',
  props: ['tamanho']
}
</script>
