<template>
    <span>
        <div class="card-image">
            <img v-if="img" :src="img">
            <span class="card-title">{{titulo || ''}}</span>
        </div>

        <div v-if="txt" class="card-content">
            <p>{{txt}}</p>
        </div>
    </span>
</template>

<script>
export default {
  name: 'CardConteudoDetalhe',
  props: ['img', 'titulo', 'txt'],
  data () {
    return {

    }
  }
}
</script>
