// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
require('../node_modules/bootstrap/less/bootstrap.less')
require('../node_modules/slick-carousel/slick/slick.css')
require('../static/css/style.css')
import App from './App'
import router from './router'


Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App },
})


