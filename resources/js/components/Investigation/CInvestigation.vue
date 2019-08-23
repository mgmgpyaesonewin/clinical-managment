<template>
<div class="">
    <div class="row">
        <div class="col-11">
        <h4>All investigation</h4>
        </div>
        <div class="col-1">
            <a v-b-modal.invest-add href="#">Add</a>
        </div>
        
        <div v-for="c in investigations" :key="c.id" class="col-12">
            <a v-b-modal.invest-edit @click="bindbyid(c.id)"  href="#">edit</a>
        </div>
    </div>
     <iform
     id="invest-add"
    :invest.sync="invest"
    @submitform="submitform()"
    :errors="ierrors"
/>
 <iform
    id="invest-edit"
    :invest.sync="invest"
    @submitform="updateform()"
    :errors="ierrors"
/>
</div>

</template>
<script>
import iform from './Form'
import {VBModal } from 'bootstrap-vue'

export default {
    components:{
        iform
    },
    directives:{
    'b-modal':VBModal
    },
    data(){
        return{
            investigations:[],
            invest:{
                term:'gg',
                doctor_id:this.$store.state.user.data.id,
                consultation_id:this.$store.state.consult,
                value:null,
                code:null,
                snomed_ct:null,
                range:null,
            },
            ierrors:{}
        }
    },
    methods: {
        bindbyid(id){
            this.invest=this.investigations.find((c)=>c.id===id)
        },
        submitform(){
        axios.post('investigations',this.invest)
        .then((res)=>{
            this.$toasted.show('Success !')
        })
        .catch((err)=>{
            this.ierrors=err.response.data
        })
        },
        updateform(){
        axios.put(`investigations/${this.invest.id}`,this.invest)
        .then((res)=>{
            this.$toasted.show('Success !')
        })
        .catch((err)=>{
            this.ierrors=err.response.data
        })
        }
    },
    mounted(){
     axios(`investigationPerConsultation/${this.$store.state.consult}`)
     .then((res)=>{
         this.investigations=res.data

        this.$$toasted.show('Success')
        console.log(this.investigations)
     })
     .catch((err)=>{
            console.log(error)
     })
    }
}
</script>