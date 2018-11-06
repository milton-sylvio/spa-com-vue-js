<template>
  <span>
    <div v-if="img !== null" class="card-image">
      <a v-if="link !== null" :href="link" target="_blank">
        <img :src="img">
        <span class="card-title">{{title || ''}}</span>
      </a>
      <span v-else>
        <img :src="img">
        <span class="card-title">{{title || ''}}</span>
      </span>
    </div>

    <div v-if="txt" class="card-content">
      <h4 v-if="img === null" class="card-title no-img">{{title || ''}}</h4>
      {{txt}}
      <p v-if="link !== null">
        <a :href="link" :title="title" class="waves-effect waves-teal btn-flat btn-link" target="_blank">Saiba mais</a>
      </p>
    </div>

  </span>
</template>

<script>
export default {
  name: 'CardDetalhe',
  props: ['img', 'title', 'link', 'txt'],
  data () {
    return {

    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.no-img {
  margin-top: 0;
}

.btn-link {
  color: #4db6ac;
  margin-top: 15px;
}
</style>
