import addpatient from '../components/Patient/AddPatient.vue'
import EmptyView from '../components/EmptyRouterView.vue';

export const patientroute = { path:'/users',  component:EmptyView, meta:{name:'Users'},
children:[
    { path: 'add',  name:'addpatient',  component: addpatient, meta: {name:'Add'} },
  ] 
};


