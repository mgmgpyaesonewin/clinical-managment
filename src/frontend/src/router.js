import Vue from 'vue'
import Router from 'vue-router'
import {routes} from './routes.js';

Vue.use(Router)
import store from './store';


const CheckAuth = (to,from,next)=>{
    store.commit('setConsult',null);
    if (to.matched.some(record => record.meta.requiresAuth)) {
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
export const router = new Router({
  mode: 'history',
  base: process.env.BASE_URL,
  linkActiveClass: "active",
  routes
})
router.beforeEach(CheckAuth)