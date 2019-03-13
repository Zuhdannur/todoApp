import Vue from 'vue'
import App from './App.vue'
import Bootstrap from 'bootstrap-vue'
import Moment from 'vue-moment'
import Notifications from 'vue-notification'

Vue.config.productionTip = false
Vue.use(Bootstrap)
Vue.use(Moment)
Vue.use(Notifications)

new Vue({
  render: h => h(App),
}).$mount('#app')
