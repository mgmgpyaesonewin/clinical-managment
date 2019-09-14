import Permissions from '../components/Permission/Index.vue';

export const PermissionRoute = { 
  path: '/permissions/:name', 
  component: Permissions,
  name: 'Permissions',
  props: true, 
  meta: {
    name:'Permissions',
  }, 
};