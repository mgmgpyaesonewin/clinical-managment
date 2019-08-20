<template>
    <div>
        <div class="row page-titles">
      <div class="col-md-5 align-self-center">
    </div>
        <div class="col-12 col-lg-12">
              <b-tabs  v-model="cindex" content-class="mt-3">
        <b-tab @click="changetab(index)" v-for="(tab,index) in Tabs"  :key="tab" :title="tab" >
        </b-tab>
        </b-tabs>
        <component @setTab="changetab(6)" 
        :is="current"></component>
          <!-- <profile/> -->
    </div>
    <!-- <div class="col-4">
        <h4 class="text-center">Detail</h4>
    </div> -->
    <!-- </div> -->
    </div>

    </div>
</template>

<script>
import Consultation from '../Consultation/AllConsultation'
import CurrentConsult from '../Consultation/CurrentConsult'
import Examination from '../Examination/AllExamination'
import Investigation from '../Investigation/AllInvestigation'
import Medication from '../Medication/AllMedication'
import Problems from '../Problems/AllProblems';
import {BTabs,BTab,BNav,BNavItem,VBModal} from 'bootstrap-vue'
import Profile from './Profile'
export default {
    components:{
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
        Selected_Consultation:CurrentConsult
    },
     directives:{
       'b-modal': VBModal
    },
     data(){
      return {
          openConsultForm:false,
          Tabs : ['Profile','Investigation','Examination',
          'Problems','Consultation','Medication','Selected_Consultation'],
          current:'profile',
          bgColor: '#778899',
          cindex:0,
          position: 'bottom-right',
          
          fabActions: [
              {
                  name: 'cache',
                  icon: 'add',
                  tooltip:'Add Problem'
              },
              {
                  name: 'alertMe',
                  icon: 'add',
                  tooltip:'Add Consultation'
              }
          ]
      }
  },
  methods:{
      changetab(index){
          this.cindex=index
          this.current=this.Tabs[index]
      },
      cache(){
          console.log('Cache Cleared');
      },
     
  },
  mounted(){
  }
}
</script>