// import addpatient from '../components/Patient/AddPatient.vue';
// import editpatient from '../components/Patient/EditPatient.vue';
import all from '../components/Patient/AllPatient.vue';
import EmptyView from '../components/EmptyRouterView.vue';
import detail from '../components/Patient/PatientDetail';
import test from '../components/Patient/test';
import report from '../components/Patient/Report';
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
    { path:'detail/:id',  component:detail,name:'patientdetail',
    meta:{
        name:'PatientDetail',
        link:'',
    }
    },
    {path:'report', component:report},
    {path:'test',component: test}
    
    // { path: 'add',  name:'addpatient',  component: addpatient,
    //     meta:{name:'Add',link:'/patients/add'}},
    // { path:'edit/:id', component:EmptyView ,
    //     meta:{name:'Edit',link:''},
    // children:[
    //     { path:'',name:'choosepatient',  component:editpatient,
    //         meta:{name:'',link:''}},
    // ]},
    ] 
};


