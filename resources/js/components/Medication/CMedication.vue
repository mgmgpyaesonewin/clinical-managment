<template>
<div class="" style="top:150px;font-size:12px;padding:0">
    <div class="row" >
        <div class="col-11">
        <h4>All {{name}}</h4>
        </div>
        <div class="col-1">
            <a v-b-modal.invest-add href="#" class="btn waves-effect waves-light btn-primary">Add</a>
        </div>
                  <hr style="width:100%" >
        <div class="col-12" style="overflow-y:scroll;height:450px" >
            <div v-for="(c,index) in medications" :key="c.id" class="row">
              <div class="col-3">
                  <div class="col-12">Name - {{c.drug}}</div>
                <div class="col-12">Dosage - {{c.dosage}}</div>
              </div>
            <div class="col-3">
                <div class="col-12">Quantity - {{c.qty}} Per  {{c.duration}} Days</div>
            </div>
            <div class="col-2">
                <div class="col-12">Type - {{c.type}}</div>
            </div>
            <div class="col-2">
                <div class="col-12">Authorizer</div>
                <div class="col-12">{{$store.state.user.data.name}}</div>
            </div>
            <div class="col-2 row">
                <div class="col-6"><a class="btn waves-effect waves-light btn-info" href="#" v-b-modal.invest-edit  @click="bindbyid(c.id)">Edit</a></div>
                <div class="col-6"><a class="btn waves-effect waves-light btn-danger" @click.prevent="deleteInvestigation(c.id,index)" href="#" >Delete</a></div>
            </div>
            <hr style="width:100%">
            </div>
        </div>

    </div>
    <mform
     id="invest-add"
    :medication.sync="medication"
    :medicationtype="medicationtype"
    @submitform="submitform()"
    :errors="ierrors"
/>
 <mform
    id="invest-edit"
    :medication.sync="medication"
    :medicationtype="medicationtype"
    @submitform="updateform()"
    :errors="ierrors"
/>
</div>
</template>
<script>
import mform from './mform'
import {VBModal } from 'bootstrap-vue'
import Swal from 'sweetalert2'

export default {
    props:['url','name'],
    components:{
        mform
    },
    directives:{
    'b-modal':VBModal
    },
    data(){
        return{
            medicationtype:['actue','repeat'],
            medications:[],
            medication:{
                drug:'',
                dosage:'',
                qty:null,
                duration: null,
                type:null,
                doctor_id:this.$store.state.user.data.id,
                consultation_id:this.$store.state.consult,
            },
            ierrors:{}
        }
    },
    mounted() {
         axios(`${this.url}PerConsultation/${this.$store.state.consult}`)
        .then((res)=>{
            this.medications=res.data

            this.$$toasted.show('Success')
            console.log(this.medications)
        })
        .catch((err)=>{
                console.log(err)
        })
             console.log(this.medications)
    },
    methods: {
         bindbyid(id){
            this.medication=this.medications.find((c)=>c.id===id)
        },
        resetmed() {
        this.medication = {
                drug:'',
                dosage:'',
                qty:null,
                duration: null,
                type:null,
                doctor_id:this.$store.state.user.data.id,
                consultation_id:this.$store.state.consult,
            };
        },
         submitform(){
             console.log(this.medication)
            axios.post(`${this.url}s`,this.medication)
            .then((res)=>{
                this.$toasted.show('Success !')
                this.medications.unshift(res.data)
                this.resetmed();
            })
            .catch((err)=>{
                console.log(err.response.data)
                this.ierrors=err.response.data
                console.log( this.ierrors);
            })
        },
        updateform(){
        axios.put(`${this.url}s/${this.medication.id}`,this.medication)
        .then((res)=>{
            this.resetmed();
            this.$toasted.show('Success !')
        })
        .catch((err)=>{
            this.ierrors=err.response.data
            console.log(this.ierrors);
        })
        },
          async alert() {
            let { value } = await Swal.fire({
                title: 'Are you sure?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            });
            return value;
        },
        async deleteInvestigation(id,index){
            if(await this.alert()){
                axios.delete(`${this.url}s/${id}`)
                .then((res)=>{
                    this.$toasted.show('Deleted Successfully !')
                    this.medications=this.medications.filter(i=>i.id!==id)
                })
                .catch((err)=>{
                    this.$toasted.show('Error Deleting Investigation Information',{icon:'fa-times-circle',type:'error'})
                })
            }
        },
    },
}
</script>