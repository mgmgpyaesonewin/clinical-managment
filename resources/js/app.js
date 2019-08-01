require('./bootstrap');
window.Vue = require('vue');
import VueRouter from 'vue-router';
import Foo from './components/Foo.vue';
import Bar from './components/Bar.vue';

const routes = [
    { path: '/foo', component: Foo },
    { path: '/bar', component: Bar }
  ]
  const router = new VueRouter({
    mode:'history',
    base:"/home",
    routes // short for `routes: routes`
  })
    

Vue.use(VueRouter)
Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    router,
    el: '#app',
});
