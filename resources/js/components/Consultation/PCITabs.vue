<template>
    <div class="row">
        <div class="col-12">
  <b-card no-body>
    <b-tabs v-model="cindex" pills  vertical>
      <b-tab @click="cindex=index" v-for="(tab,index) in ctabs" :key="tab" :title="tab" >
          <component :is="tab"></component>
      </b-tab>
    </b-tabs>
  </b-card>
        </div>
    </div>
</template>
<script>
import {BTabs,BTab,BCard,BCardText} from 'bootstrap-vue'
import Investigation from '../Investigation/CInvestigation'
import Problems from '../Problems/CProblems'
import Medication from '../Medication/CMedication'
export default {
    data(){
        return{
            cindex:0,
            ctabs:['Investigation','Problems','Medication']
        }
    },
    computed:{
    },
    components:{
        BTabs,BTab,BCard,BCardText,Investigation,Medication,Problems
    }
}
</script>