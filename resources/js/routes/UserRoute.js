import AddUser from '../components/User/AddUser.vue'
import EmptyView from '../components/EmptyRouterView.vue';
import EditUser from '../components/Patient/EditUser.vue';
import Users from '../components/Patient/AllPatient.vue';
import EmptyView from '../components/EmptyRouterView.vue';

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
