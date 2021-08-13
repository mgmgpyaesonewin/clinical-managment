import AllConsultation from "../components/Consultation/AllConsultation.vue";

export const Consultation = {
  path: '/consultations', component: AllConsultation,
  meta: { name: 'Consultations', link: '/consultations', requiresAuth: true },
}
