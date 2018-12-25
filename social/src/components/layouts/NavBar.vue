<template>
    <nav :class="cor || 'green darken-3'">
      <div class="nav-wrapper container">
        <a v-bind:href="url || '/'" class="brand-logo" :title="$store.getters.getProject">
          <img :src="logo" :alt="['Logo ', $store.getters.getProject]">
        </a>

        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <slot />
        </ul>
      </div>
    </nav>
</template>

<script>
import logo from '@/assets/img/logo-undici.svg'

export default {
  name: 'NavBar',
  props: ['url', 'cor'],
  data: function () {
    return {
      logo: logo
    }
  }

  // created () {
  //   // this.$store.commit('setProject', 'Facebosta')
  // }
}
</script>

<style lang="scss">
.brand-logo {
  height: 50px;

  > img {
    height: 50px;
  }
}

.text-brand{fill:#737373;}
.st5{fill:#CC6742;}
</style>
