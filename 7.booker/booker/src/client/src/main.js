// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VueResource from 'vue-resource'

Vue.use(VueResource)

Vue.config.productionTip = false
Vue.config.devtools = true

router.beforeEach((to, from, next) => {
  
    	let id = getCookie("id")

    	if(id){
    		to.meta.login = true
    		next()
    	}else{
  			if(to.path != '/'){
  				to.meta.login = false	
  				next('/')
  			}else{
  				next()
  			}
    	}

    
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
