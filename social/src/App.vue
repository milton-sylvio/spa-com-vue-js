<template>
  <router-view/>
</template>

<script>
export default {
  name: 'app',
  created () {
    document.title = 'undici'
  }
}
</script>
