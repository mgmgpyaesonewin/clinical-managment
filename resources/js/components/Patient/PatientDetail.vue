<template>
    <div>
        <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Patient Detail</h4>
    </div>
      <div class="col-md-7 col-7 col-sm-7  align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
           <breadcrum />        </div>
    </div>
    <!-- <div class="row"> -->
        <div class="col-8 col-lg-8">
              <b-tabs content-class="mt-3">
        <b-tab @click="changetab(index)" v-for="(tab,index) in Tabs" :key="tab" :title="tab" >
        </b-tab>
        </b-tabs>
        <component :is="current"></component>
          <!-- <profile/> -->
    </div>
    <div class="col-4">
        <h4 class="text-center">Detail</h4>
    </div>
    <!-- </div> -->
    </div>
    <fab
   :position="position"
   :bg-color="bgColor"
   icon-size='small'
   :actions="fabActions"
   fixed-tooltip=true
   @cache="cache"
   @alertMe="alert"
></fab>
    </div>
</template>

<script>

import fab from 'vue-fab'
import {BTabs,BTab,BNav,BNavItem} from 'bootstrap-vue'
import Profile from './Profile'
export default {
    components:{
        BTabs,
          fab,
          BNav,
          BNavItem,
        BTab,
        Profile
    }, data(){
      return {
          Tabs : ['Profile','Investigation','Problems','Consultation','Medication'],
          current:'profile',
          bgColor: '#778899',
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
          this.current=this.Tabs[index]
      },
      cache(){
          console.log('Cache Cleared');
      },
      alert(){
          alert('Clicked on alert icon');
      }
  }
}
</script>