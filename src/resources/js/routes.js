import {patientroute} from './routes/patientroute';
import { UserRoute } from './routes/UserRoute';
import { RoleRoute } from './routes/RoleRoute';
import { PermissionRoute } from './routes/permissionRoute';

export const routes = [
  patientroute,
  UserRoute,
  RoleRoute,
  PermissionRoute
];
