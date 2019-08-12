import AddUser from '../components/User/AddUser.vue'
import Auth from '../components/User/Auth.vue'
import EmptyView from '../components/EmptyRouterView.vue';
import EditUser from '../components/User/EditUser.vue';
import Users from '../components/Patient/AllPatient.vue';
// import EmptyView from '../components/EmptyRouterView.vue';

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
    { 
      path: 'add', 
      name: 'adduser',
      component: AddUser, 
      meta: {
        name:'Add'
      }
    },
    { path: 'login',  name:'login',  component: EmptyView, meta: {name:'Login',link:'/users/login'} },
    { 
      path: 'edit/:id', 
      component: EmptyView ,
      meta: {
        name: 'Edit',
        link: ''
      },
      children: [
        { 
          path: '',
          name: 'chooseuser',  
          component: EditUser,
          meta: {
            name: '',
            link: ''
          }
        },
    ]}
  ] 
};
