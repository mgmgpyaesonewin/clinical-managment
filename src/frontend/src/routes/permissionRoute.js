import Permissions from '../components/Permission/Index.vue';

export const PermissionRoute = { 
  path: '/permissions/:id', 
  component: Permissions,
  name: 'Permissions',
  props: true, 
  meta: {
    name:'Permissions',
  }, 
};