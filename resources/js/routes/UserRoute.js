import AddUser from '../components/User/AddUser.vue'
import Auth from '../components/User/Auth.vue'
import EmptyView from '../components/EmptyRouterView.vue';
export const UserRoute = { path:'/users',  component:EmptyView, meta:{name:'Users'},
children:[
    { path: 'add',  name:'adduser',  component: AddUser, meta: {name:'Add'} },
    { path: 'login',  name:'login',  component: EmptyView, meta: {name:'Login',link:'/users/login'} },

  ] 
};


