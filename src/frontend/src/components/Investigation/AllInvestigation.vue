<template>
    <div>
        <div class="row">
            <div class="col-11">
                <h4>All Invenstigations</h4>

            </div>
            <div class="col-1">
                <a v-b-modal.invest-add href="#" class="btn waves-effect waves-light btn-primary" >Add</a>
            </div>
            
            <div class="col-12"  >
                <hr style="width:100%" >
                <div v-for="investigation in investigations" :key="investigation.id" class="row">
                    <div class="col-3">
                        <div class="col-12">Term - {{investigation.term}}</div>
                        <div class="col-12">Code - {{investigation.code}}</div>
                    </div>
                     <div v-if="checkpending(investigation.value)" class="col-6">
                        <span><img style="width:80px;height:50px;background-color:transparent;" src="../../assets/images/hourglass.gif" alt="asdasd"> Pending....</span>
                    </div>
                    <div v-else class="col-9">
                        <div class="row">
                        <div  class="col-8">
                            <div class="col-6">Range: {{investigation.range}}</div>
                            <div class="col-6">Value: {{investigation.value}}</div>
                        </div>
                        <div  class="col-4">
                            <div class="col-6">Authorizer</div>
                            <div class="col-6">
                             {{investigation.doctor.name}}
                            </div>
                        </div>
                        </div>
                    </div>
                    <hr style="width:98%">
                </div>
            </div>
        </div>
             <iform
     id="invest-add"
    :invest.sync="invest"
    @submitform="submitform()"
    :errors="ierrors"
/>
    </div>
</template>
<style >
    .glass{
        widows: 50px;
        height: 50px;
        background-image: '../assets/images/hourglass.gif'
    };
</style>
<script>
import iform from './Irequestform'

import {VBModal } from 'bootstrap-vue'

export default {
    components:{
        iform
    },
    data () {
        return {
            investigations : [],
            invest:{
                term:null,
                doctor_id:this.$store.state.user.data.id,
                patient_id:this.$route.params.id,
                value:null,
                code:null,
                snomed_ct:null,
                range:null,
            },
            ierrors:{}
        }
    },
    directives:{
    'b-modal':VBModal
    },
    methods:{
        checkpending(value){
            return value===null;
        },
        submitform(){
            console.log(this.invest)
            this.invest.code=`(${this.invest.code.code}) ${this.invest.code.title}`
            axios.post(`investigations`,this.invest)
            .then((res)=>{
                this.$toasted.show('Success !')
                console.log(res.data)
                this.investigations.unshift(res.data)
                
            })
            .catch((err)=>{
                this.ierrors=err.response.data
            })
         },
    },
    mounted () {
        axios.get(`investigationPerPatient/${this.$store.state.patient.id}`)
        .then(response => {
            this.investigations = response.data;
        });
    } 
}
</script>