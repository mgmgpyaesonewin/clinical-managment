import { patientroute } from './routes/patientroute';
import { UserRoute } from './routes/UserRoute';
import { RoleRoute } from './routes/RoleRoute';
import investresult from './components/Investigation/InvestigationResult'
import { PermissionRoute } from './routes/permissionRoute';
import About from './views/About';
import { doctorRoutes } from './routes/doctorroutes';
import { ProductRoute } from './routes/ProductRoute';
import { AppointmentRoute } from './routes/AppointmentRoute';
import {sroute} from './routes/serviceRoute'
import Checkout from './components/Checkout.vue';
import { Consultation } from "./routes/Consultation";

export const routes = [
  patientroute,
  UserRoute,
  RoleRoute,
  doctorRoutes,
  ProductRoute,
  Consultation,
  ...sroute,
  ...AppointmentRoute,
  {
    path: "/investresult", component: investresult
  },
  PermissionRoute,
  {
    path: '/checkout', component: Checkout
  },
  { path: "*", component: About }
];