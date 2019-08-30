<template>
    <div class="row">
        <div class="col-12">
            <b-card no-body>
                <b-tabs v-model="cindex" pills  vertical>
                <b-tab @click="cindex=index" v-for="(tab,index) in ctabs" :key="tab" :title="tab" >
                </b-tab>
                 <component :url="name.toLowerCase()" :name="name" :is="name"></component>
                </b-tabs>
            </b-card>
        </div>
    </div>
</template>
<script>
import {BTabs,BTab,BCard,BCardText} from 'bootstrap-vue'
import Investigation from '../Investigation/CInvestigation'
import Examination from '../Investigation/CInvestigation'
import Problems from '../Problems/CProblems'
import Medication from '../Medication/CMedication'
export default {
    data(){
        return{
            cindex:0,
            ctabs:['Investigation','Problems','Medication','Examination']
        }
    },
    computed:{
        name(){
            return this.ctabs[this.cindex];
        }
    },
    components:{
        BTabs,BTab,BCard,BCardText,Investigation,Medication,Problems,Examination
    }
}
</script>