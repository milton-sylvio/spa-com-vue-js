<template>
    <nav :class="cor || 'green darken-3'">
      <div class="nav-wrapper container">
        <router-link :to="url || '/'" class="brand-logo" :title="logo || 'Social'">{{logo || 'Social'}}</router-link>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <slot />
        </ul>
      </div>
    </nav>
</template>

<script>
export default {
  name: 'NavBar',
  props: ['logo', 'url', 'cor']
}
</script>
