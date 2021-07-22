import Vue from 'vue';
import VueRouter from 'vue-router'; 
import {routes} from './routes.js';
import store from './store';


const CheckAuth = (to,from,next)=>{
    store.commit('setConsult',null);
    if (to.matched.some(record => record.meta.requiresAuth)) {
        console.log(store.getters.isTokenValid)
        if (!store.getters.isTokenValid) {
          next({
            path: 'users/login',
            query: { redirect: to.fullPath }
          })
        } else {
          next()
        }
      } else {
        next() // make sure to always call next()!
      }
}
Vue.use(VueRouter);
export const router = new VueRouter({
mode:'history',
base:"/home",
linkActiveClass: "active",
routes // short for `routes: routes`
})
router.beforeEach(CheckAuth)