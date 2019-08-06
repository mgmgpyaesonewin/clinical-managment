import addpatient from '../components/Patient/AddPatient.vue';
import editpatient from '../components/Patient/EditPatient.vue';
import all from '../components/Patient/AllPatient.vue';
import EmptyView from '../components/EmptyRouterView.vue';

export const patientroute = { path:'/patients',  component:EmptyView,meta:{name:'Patients'},
children:[
  { path:'all',name:'allpatient',  component:all,meta:{name:'All'}},
  { path: 'add',  name:'addpatient',  component: addpatient,meta:{name:'Add'}},
  { path:'edit', name:'editpatient', component:EmptyView ,meta:{name:'Edit'},
  children:[
    { path:':id',name:'choosepatient',  component:editpatient,meta:{name:''}},
  ]},
] 
};


