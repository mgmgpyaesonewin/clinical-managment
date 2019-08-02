require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router';
import mainComponent from './components/Main.vue';
import {routes} from './routes.js';
console.log(routes);
  
  const router = new VueRouter({
    mode:'history',
    base:"/home",
    routes // short for `routes: routes`
  })
    

Vue.use(VueRouter)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    el: '#app',
    components: {
      mainComponent
    }
});
