<template>
  <div id="app">
    <header-book></header-book>
    <transition name="component-fade" mode="out-in">
      <router-view/>
    </transition>
  </div>
</template>

<script>
import HeaderBook from './components/HeaderBook'
export default {
  name: 'app',
  components:{
    HeaderBook
  }
}
</script>

<style>
#app {
  font-family: 'Avenir', Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

.component-fade-enter-active, .component-fade-leave-active {
  transition: opacity .3s ease;
}
.component-fade-enter, .component-fade-leave-to
/* .component-fade-leave-active до версии 2.1.8 */ {
  opacity: 0;
}
</style>
