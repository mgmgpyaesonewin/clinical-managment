require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router';
import mainComponent from './components/Main.vue';
import TopNav from './components/Nav.vue';
import SideBar from './components/Sidebar.vue';

const routes = [
    { path: '/foo', component: TopNav },
    { path: '/bar', component: SideBar }
  ]
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
