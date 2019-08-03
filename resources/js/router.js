import Vue from 'vue';
import VueRouter from 'vue-router'; 
import {routes} from './routes.js';
import store from './store';

Vue.use(VueRouter);
export const router = new VueRouter({
mode:'history',
base:"/home",
linkActiveClass: "active",
routes // short for `routes: routes`
})
router.afterEach((to, from) => {
    const breadcrum = to.fullPath.split("/").slice(1);
    store.commit('setBreadcrum',breadcrum);
})