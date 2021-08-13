import EmptyView from '../components/EmptyRouterView.vue';
import Users from '../components/User/AllUser.vue';

export const UserRoute = { 
  path: '/users', component:EmptyView, meta:{name:'Users'},
  children:[
    { 
      path: '',
      name: 'alluser', 
      component: Users, 
      meta: {
        name: 'All',
        link: '/users'
      }
    },
    { path: 'login',  name:'login',  component: EmptyView, meta: {name:'Login',link:'/users/login'} },
  ] 
};
