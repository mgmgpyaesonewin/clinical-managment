<template>
<div class="">
    <div class="row">
        <div class="col-11">
        <h4>All Examination</h4>
        </div>
        <div class="col-1">
            <a v-b-modal.exam-add href="#">Add</a>
        </div>
        
        <div class="col-12" style="overflow-y:scroll;height:500px;" >
          <hr style="width:100%" >
            <div v-for="c in examinations" :key="c.id" class="row">
              <div class="col-5">
                  <div class="col-12">Term - {{c.term}}</div>
                <div class="col-12">Value -{{c.value}}</div>
              </div>
            <div class="col-2">
                <div class="col-12">Range</div>
                <div class="col-12">{{c.range}}</div>
            </div>
            <div class="col-3">
                <div class="col-12">Code:{{c.code}}</div>
                <div class="col-12">Snomed CT:{{c.snomed_ct}}</div>
            </div>
            <div class="col-2">
                <div class="col-12"><a href="#" v-b-modal.exam-edit  @click="bindbyid(c.id)">Edit</a></div>
                <div class="col-12"><a @click.prevent="deleteInvestigation(c.id)" href="#" >Delete</a></div>
            </div>
            <hr style="width:100%">
            </div>
        </div>
    </div>
     <iform
     id="exam-add"
    :invest.sync="exam"
    @submitform="submitform()"
    :errors="ierrors"
/>
 <iform
    id="exam-edit"
    :invest.sync="exam"
    @submitform="updateform()"
    :errors="ierrors"
/>
</div>

</template>
<script>
import iform from '../Investigation/Form'
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
            examinations:[],
            exam:{
                term:'',
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
            this.invest=this.examinations.find((c)=>c.id===id)
        },
        submitform(){
        axios.post('examinations',this.invest)
        .then((res)=>{
            this.$toasted.show('Success !')
        })
        .catch((err)=>{
            this.ierrors=err.response.data
        })
        },
        updateform(){
        axios.put(`examinations/${this.invest.id}`,this.invest)
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
         this.examinations=res.data

        this.$$toasted.show('Success')
        console.log(this.investigations)
     })
     .catch((err)=>{
            console.log(error)
     })
    }
}
</script>