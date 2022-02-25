import '@babel/polyfill'
import Vue from 'vue'
import 'mutationobserver-shim'
import './utils/fliter'
import './config/firebase'
import App from './App.vue'
import router from './router'
import store from './store'
// import Raphael from 'raphael/raphael'
import './plugins'
import './registerServiceWorker'
// import AlgoliaComponents from 'vue-instantsearch'
import i18n from './i18n'
import './directives'
// global.Raphael = Raphael

// Vue.use(AlgoliaComponents)

Vue.config.productionTip = false

// console.log(process.env.NODE_ENV)
// console.log(process.env.VUE_APP_BASE_URL)
// console.log(process.env.VUE_APP_PORT)

const vm = new Vue({
  router,
  store,
  i18n,
  render: h => h(App)
}).$mount('#app')

// window.vm = vm
