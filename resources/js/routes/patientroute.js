import addpatient from '../components/Patient/AddPatient.vue';
import editpatient from '../components/Patient/EditPatient.vue';
import all from '../components/Patient/AllPatient.vue';
import EmptyView from '../components/EmptyRouterView.vue';

export const patientroute = { 
    path:'/patients',  component:EmptyView,
    meta:{name:'Patients',link:'/patients',requiresAuth: true},
    children:[
    { path:'',  component:all,name:'allpatient',
        meta:{
            name:'All',
            link:'/patients',
        }
    },
    { path: 'add',  name:'addpatient',  component: addpatient,
        meta:{name:'Add',link:'/patients/add'}},
    { path:'edit/:id', component:EmptyView ,
        meta:{name:'Edit',link:''},
    children:[
        { path:'',name:'choosepatient',  component:editpatient,
            meta:{name:'',link:''}},
    ]},
    ] 
};


