import addpatient from './components/Patient/AddPatient.vue';
import editpatient from './components/Patient/EditPatient.vue';
import addUser from './components/User/AddUser.vue';
import all from './components/Patient/AllPatient.vue';

export const routes = [
    { path: '/patients/add',    component: addpatient },
    { path:'/patients/edit/:id',  component:editpatient },
    { path:'/patients',  component:all },
    { path: '/users/add',    component: addUser }
  ]