import AppointmentView from '../components/Appointment/Appointment'
import Dalist from "../components/Appointment/DAList"


export const AppointmentRoute = [  
{  path: "/appointments", component: AppointmentView, meta: { name: 'Appointment' }},
{  path: "/doctor/appointments", component :Dalist , meta: {name:'Apoointment'}},
]

