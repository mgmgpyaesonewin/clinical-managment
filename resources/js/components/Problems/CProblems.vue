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

        <!-- <div v-for="c in investigations" :key="c.id" class="col-12">
            <a v-b-modal.invest-edit @click="bindbyid(c.id)"  href="#">edit</a>
        </div> -->
        <div class="col-12" style="overflow-y:scroll;height:450px" >
            <div v-for="(c,index) in problems" :key="c.id" class="row">
              <div class="col-3">
                  <div class="col-12">Name - {{c.name}}</div>
                <div class="col-12">Code - {{c.code}}</div>
              </div>
            <div class="col-2">
                <div class="col-12">Type - {{c.type}}</div>
                <div class="col-12">Status - {{c.status}}</div>
            </div>
            <div class="col-3">
                <div class="col-12">Start Date - {{c.start_time}}</div>
                <div class="col-12">End Date - {{c.end_time}}</div>
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
     <pform
     id="invest-add"
    :problem.sync="problem"
        :statusoption="statusoption"
    :typeoption="typeoption"
        :durationoption="durationoption"

        :actionoption="actionoption"
    @submitform="submitform()"
    :errors="ierrors"
/>
 <pform
    id="invest-edit"
    :problem.sync="problem"
    :statusoption="statusoption"
    :durationoption="durationoption"
    :actionoption="actionoption"
        :typeoption="typeoption"
    @submitform="updateform()"
    :errors="ierrors"
/>
</div>

</template>
<script>
import pform from './Form'
import {VBModal } from 'bootstrap-vue'
import Swal from 'sweetalert2'

export default {
    props:['url','name'],
    components:{
        pform
    },
    directives:{
    'b-modal':VBModal
    },
    data(){
        return{
            typeoption:['minor','significant'],
            // statusoption:[{
            //     name:'Active',
            //     value: true,
            // },{
            //     name:'Inactive',
            //     value: false,
            // }],
            actionoption:['Combine','Evolve','Group'],
            durationoption:['7 days','14 days','28 days','3 mon','6 mon','1 yr','custom'],
            statusoption:['Active Problem','Past/Ended Problem'],
            problems:[],
            problem:{
                patient_id:this.$route.params.id,
                name:'',
                type:'',
                start_time:null,
                end_time:null,
                status:'',
                duration:null,
                doctor_id:this.$store.state.user.data.id,
                consultation_id:this.$store.state.consult,
                code:null,
            },
            ierrors:{}
        }
    },
    methods: {
        bindbyid(id){
            this.problem=this.problems.find((c)=>c.id===id)
        },
        submitform(){
            axios.post(`${this.url}s`,this.problem)
            .then((res)=>{
                this.$toasted.show('Success !')
                this.problems.unshift(res.data)
            })
            .catch((err)=>{
                this.ierrors=err.response.data.errors
                console.log( this.ierrors);
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
                    this.problems=this.problems.filter(i=>i.id!==id)
                })
                .catch((err)=>{
                    this.$toasted.show('Error Deleting Investigation Information',{icon:'fa-times-circle',type:'error'})
                })
            }
        },
        updateform(){
        axios.put(`${this.url}s/${this.problem.id}`,this.problem)
        .then((res)=>{
            this.$toasted.show('Success !')
        })
        .catch((err)=>{
            this.ierrors=err.response.data
            console.log(this.ierrors);
        })
        }
    },
    mounted(){
     axios(`${this.url}PerConsultation/${this.$store.state.consult}`)
     .then((res)=>{
         this.problems=res.data

        this.$$toasted.show('Success')
        console.log(this.problems)
     })
     .catch((err)=>{
            console.log(err)
     })
     
    }
}
</script>