import Vue from 'vue'
import { router } from './router'
import store from './store'
import axios from 'axios'
import 'popper.js'
import 'bootstrap-datepicker'
import Toasted from 'vue-toasted'
import moment from 'moment'
window.moment = moment
import { BootstrapVue } from 'bootstrap-vue'

import App from './App.vue'

import { ClientTable } from 'vue-tables-2'
import { ServerTable } from 'vue-tables-2'
import CKEditor from '@ckeditor/ckeditor5-vue'

Vue.use(CKEditor)
Vue.use(ClientTable, {}, false, 'bootstrap4')

Vue.use(ServerTable)
Vue.component('breadcrum', require('./components/breadcrum.vue').default)
Vue.component('pulse-loader', require('vue-spinner/src/PulseLoader.vue').default)

window.axios = axios.create({
  baseURL: `${process.env.VUE_APP_API_URL}`,
})

window.axios.interceptors.request.use(
  function(config) {
    if (store.getters.isTokenValid) {
      config.headers.Authorization = `Bearer ${store.state.user.access_token}`
    }
    return config
  },
  function(error) {
    return Promise.reject(error)
  }
)

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'

Vue.use(Toasted, {
  theme: 'outline',
  type: 'success',
  position: 'top-right',
  iconPack: 'fontawesome',
  icon: {
    name: 'fa-check-circle',
    color: 'blue',
    after: false, // this will append the icon to the end of content
  },
  duration: 2000,
})

Vue.use(BootstrapVue)

Vue.mixin({
  data() {
    return {
      baseUrl: '',
    }
  },
  methods: {
    $can(permissionName) {
      return store.state.user.permissions.indexOf(permissionName) !== -1
    },
    $isNotNull(value) {
      return value !== null
    },
  },
  created() {
    this.baseURL = `${process.env.VUE_APP_API_URL}`
  },
})

Vue.config.productionTip = false

// Importing the global css file
import '@/assets/global.css'

new Vue({
  router,
  store,
  render: h => h(App),
}).$mount('#app')
