// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import Vuetify from 'vuetify'
import VueResource from 'vue-resource';

Vue.use(Vuetify)
Vue.use(VueResource);
Vue.config.productionTip = false
Vue.config.devtools = true

router.beforeEach((to, from, next) => {
	
	if(node_mode){
		let resp = {id_role:1}	
		var date = new Date(new Date().getTime() + 60 * 1000);
		document.cookie = "id=11; path=/; expires=" + date.toUTCString();
		document.cookie = "hash=fa39f1d6b2b1afbfd6a2e8adfddcc2a9; path=/; expires=" + date.toUTCString();
			
    }else{
    	let id = getCookie("id")
    	if(id){
    		to.meta.login = true
    	}else{
    		to.meta.login = false
    	}
    }

	next();
})

/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})
