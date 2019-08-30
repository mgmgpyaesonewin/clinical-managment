import EmptyView from '../components/EmptyRouterView.vue';
import Roles from '../components/Role/AllRole.vue';

export const RoleRoute = { 
  path: '/roles', component:EmptyView, meta:{name:'Roles'},
  children:[
    { 
      path: '',
      name: 'allrole', 
      component: Roles, 
      meta: {
        name: 'All',
        link: '/roles'
      }
    }
  ] 
};
