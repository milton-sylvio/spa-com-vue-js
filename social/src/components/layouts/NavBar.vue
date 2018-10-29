<template>
    <nav :class="cor || 'green darken-3'">
      <div class="nav-wrapper container">
        <a v-bind:href="url || '/'" class="brand-logo">{{logo || 'Site'}}</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <slot />
        </ul>
      </div>
    </nav>
</template>

<script>
export default {
  name: 'NavBar',
  props: ['logo', 'url', 'cor'],
  created () {
    // this.$store.commit('setNome', 'Facebosta')
  }
}
</script>

<style lang="scss">
.brand-logo {
  text-transform: uppercase;
}
</style>
