<template>
  <div class="center-align">
    <div class="preloader-wrapper active">
      <div class="spinner-layer spinner-orange-only">
        <div class="circle-clipper left">
          <span class="circle"></span>
        </div>
        <div class="gap-patch">
          <span class="circle"></span>
        </div>
        <div class="circle-clipper right">
          <span class="circle"></span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Preloader'
}
</script>

<style lang="scss">
.spinner-layer {
  border-color: #f57c00;
}
</style>
