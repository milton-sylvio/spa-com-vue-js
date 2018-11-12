<template>
  <div v-if="!closeAlert" :class="'alert ' + color + ' darken-4'">
    <i class="material-icons">{{icon}}</i>
    {{ msgAlert(msg) }}
    <i v-if="showClose" @click="close()" class="material-icons close" title="Fechar">close</i>
  </div>
</template>

<script>
export default {
  name: 'Alerts',
  props: ['type', 'msg', 'showClose'],
  data: () => ({
    icon: '',
    color: '',
    closeAlert: false
  }),
  created () {
    this.typeAlert()
  },
  methods: {
    typeAlert () {
      switch (this.type) {
        case 'error':
          this.color = 'red'
          this.icon = 'error'
          break
        case 'success':
          this.color = 'teal'
          this.icon = 'check_circle'
          break
        case 'info':
          this.color = 'light-blue'
          this.icon = 'info'
          break
        case 'warning':
          this.color = 'yellow'
          this.icon = 'warning'
          break
        default:
          break
      }
    },
    msgAlert (msg) {
      let txt

      if (Array.isArray(msg)) {
        txt = '<ul>'

        txt += msg.forEach(m => {
          let li = `<li>${m}</li>`
          txt.push(li)
        })

        txt += '</ul>'

        return txt
      } else {
        return msg
      }
    },
    close () {
      this.closeAlert = true
    }
  }
}
</script>

<style lang="scss">
  .alert {
    color: #fff;
    padding: 15px 20px;
    position: relative;
    transition: all .4s ease;

    i:not(.close) {
      float: left;
      margin-right: 20px;
    }

    .close {
      cursor: pointer;
      position: absolute;
      right: 15px;
      transition: all .4s ease;

      &:hover,
      &:focus {
        transform: rotate(180deg)
      }
    }
  }
</style>
