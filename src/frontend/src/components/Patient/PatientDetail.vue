<template>
  <div>
    <div class="row">
      <div class="col-12 col-xs-12">
        <div class="card">
          <div class="card-body">
            <b-tabs v-model="cindex" content-class="mt-3" class="customtab">
              <b-tab :ref="index" v-for="(tab, index) in Tabs" :key="tab" :title="tab"></b-tab>
            </b-tabs>
            <component :is="current" @setTab="cindex = 6"></component>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { bus } from '@/eventbus'
import Consultation from '../Consultation/AllConsultation'
import CurrentConsult from '../Consultation/CurrentConsult'
import Examination from '../Examination/AllExamination'
import Investigation from '../Investigation/AllInvestigation'
import Medication from '../Medication/MedicationsView'
import Problems from '../Problems/AllProblems'
import { BTabs, BTab, BNav, BNavItem, VBModal } from 'bootstrap-vue'
import Profile from './Profile'
import PatientNavbar from '../Patient/PatientNavbar'
export default {
  name: 'PatientDetail',
  components: {
    BTabs,
    BNav,
    BNavItem,
    Problems,
    Investigation,
    BTab,
    Medication,
    Profile,
    Examination,
    Consultation,
    Current_Consultation: CurrentConsult,
    'patient-navbar': PatientNavbar,
  },
  directives: {
    'b-modal': VBModal,
  },
  data() {
    return {
      openConsultForm: false,
      Tabs: [
        'Profile',
        'Investigation',
        'Examination',
        'Problems',
        'Consultation',
        'Medication',
        'Current_Consultation',
      ],
      current: 'Consultation',
      cindex: 4,
    }
  },
  methods: {
    checkactive(index) {
      return index === this.cindex
    },
    changeCurrentConsultationTab() {
      this.cindex = 6
    },
  },
  watch: {
    cindex(newv, oldv) {
      if (newv == 6 && !this.$store.state.consult) {
        window.alert('please select one consultation')
        this.cindex -= 2
      }
      this.current = this.Tabs[newv]
    },
  },
  mounted() {
    bus.$on('select-consultation', this.changeCurrentConsultationTab)
  },
}
</script>