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

    <div v-if="txt" class="card-content-text">
      <h4 v-if="img === null" class="card-title no-img">{{title || ''}}</h4>

      <span v-if="link !== null">
        <a :href="link" :title="title" class="grey-text txt-linked" target="_blank">{{txt}}</a>
      </span>
      <span v-else  class="grey-text">{{txt}}</span>
    </div>

  </span>
</template>

<script>
export default {
  name: 'CardDetalhe',
  props: ['img', 'title', 'link', 'txt']
}
</script>

<style lang="scss">
.no-img {
  margin-top: 0;
}

.card-content-text {
  padding-top: 25px;

  .txt-linked {
    transition: opacity .5s ease;

    &:hover,
    &:focus {
      opacity: .75;
    }
  }
}
</style>
