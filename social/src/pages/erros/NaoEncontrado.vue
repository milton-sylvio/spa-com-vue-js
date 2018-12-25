<template>
  <div class="page-error">
    <div class="container center-align">
      <h1>404</h1>
      <h2>Esta página não pode ser encontrada!</h2>
      <p class="white-text">Mas temos muitas outras páginas para você ver.</p>

      <a href="/" class="waves-effect waves-light btn orange darken-4">
        <i class="material-icons left">arrow_back</i>
        Voltar
      </a>
    </div>
  </div>
</template>

<script>
export default {
  name: 'NaoEncontrado',
  created () {
    document.body.classList.add('not-found')
  }
}
</script>

<style lang="scss">

$color-shadow-main: #f57c00;
$color-shadow-secondary: #e65100;

html {
  background-color: $color-shadow-main;
  background-image: url(../../assets/img/clouds.png);
  background-repeat: no-repeat;
  background-position: bottom center;
  height: 100%;
  z-index: 101;
}

body,
html {
  margin: 0;
  padding: 0;
}

body {
  &.not-found {
    background-color: transparent;
  }
}

.page-error {
  height: 100%;
  position: relative;
  z-index: 100;
}

h1 {
  font-size: 14rem;
  font-weight: bold;
  color: #fff;
  -webkit-transform: skewY(-15deg);
  -ms-transform: skewY(-15deg);
  transform: skewY(-15deg);
  text-shadow: 1px 1px 1px $color-shadow-main, 2px 2px 1px $color-shadow-main, 3px 3px 1px $color-shadow-main,
               4px 4px 1px $color-shadow-main, 9px 9px 1px $color-shadow-secondary, 5px 5px 1px $color-shadow-main,
               6px 6px 1px $color-shadow-main, 7px 7px 1px $color-shadow-main, 8px 8px 1px $color-shadow-main,
               10px 10px 1px $color-shadow-secondary, 11px 11px 1px $color-shadow-secondary, 12px 12px 1px $color-shadow-secondary,
               13px 13px 1px $color-shadow-secondary, 14px 14px 1px $color-shadow-secondary, 15px 15px 1px $color-shadow-secondary,
               16px 16px 1px $color-shadow-secondary, 17px 17px 1px $color-shadow-secondary, 18px 18px 1px $color-shadow-secondary,
               19px 19px 1px $color-shadow-secondary, 20px 20px 1px $color-shadow-secondary, 21px 21px 1px $color-shadow-secondary,
               22px 22px 1px $color-shadow-secondary, 23px 23px 1px $color-shadow-secondary, 24px 24px 1px $color-shadow-secondary,
               25px 25px 1px $color-shadow-secondary, 26px 26px 1px $color-shadow-secondary, 27px 27px 1px $color-shadow-secondary,
               28px 28px 1px $color-shadow-secondary, 29px 29px 1px $color-shadow-secondary, 30px 30px 1px $color-shadow-secondary;
  -webkit-backface-visibility: hidden;
}

h2 {
  color: #fff;
  text-shadow: 1px 1px 1px $color-shadow-secondary;
}
</style>
