<template>
    <div>
        <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Information Of All Patients</h4>
    </div>
      <div class="col-md-7 col-7 col-sm-7  align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
           <breadcrum />
            <button type="button" v-b-modal.create class="btn btn-info  d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> New Patient</button>
        </div>
    </div>
    <div class="row">
   <patientform
            :errors.sync="errors"
            :patient.sync="this.patient"
            modal='create'
            @resetpatient="resetpatient()"
            @formsubmit="saveUser()"
            />
     <patientform
            :errors.sync="errors"
            :patient.sync="patient"
            modal='edit'
            @formsubmit="saveEditedUser()"
            />
    </div>
    </div>
            <div class="col-12 ">


<div >
  <v-client-table 
  @row-click="testing($event)"
  :columns="columns" :data="patients" :options="options">
    <div slot="action" slot-scope="props" >
    <a href="#" @click.prevent="binddata(props.row.id)" v-b-modal.edit class="fa fa-edit"></a>
    <delete @deleteRow="deleterow($event)" :patients.sync='patients' :index='props.index' :data="props.row"></delete>
      </div>
      <template slot="child_row" slot-scope="props">
      <div><b>Address :</b> {{props.row.address}}</div>
      <div><b>Gender :</b> {{props.row.gender}}</div>
      <div><b>City :</b> {{props.row.city}}</div>
    </template>
  </v-client-table>
</div>
            </div>
    </div>
</template>
<style lang="css">
.table td,
.table th{
padding: 0.5rem
}
.table{
    /* padding:0 !important;
    margin:0 !important;
     */
   border: 0px;
    padding:0; 
    border-spacing: 0;
    margin:0;
    border-collapse: collapse;
}
.VuePagination {
  text-align: center;
}

.vue-title {
  text-align: center;
  margin-bottom: 10px;
}

.vue-pagination-ad {
  text-align: center;
}

.glyphicon.glyphicon-eye-open {
  width: 16px;
  display: block;
  margin: 0 auto;
}

th:nth-child(3) {
  text-align: center;
}

.VueTables__child-row-toggler {
  width: 16px;
  height: 16px;
  line-height: 16px;
  display: block;
  margin: auto;
  text-align: center;
}

.VueTables__child-row-toggler--closed::before {
  content: "+";
}

.VueTables__child-row-toggler--open::before {
  content: "-";
}

.modal-backdrop{
  background-color: #00000085 !important;
}
</style>
<script>

var patientmodel=()=>
 {
    return {
      name: null,
    address: null,
    city: null,
    phone_number: null,
    dob: null,
    gender: 'Male',
    }
}
import { BModal, VBModal,BButton } from 'bootstrap-vue'
// console.log(Bmodal)
import Vue from 'vue';
import patientform from './PatientForm';
import deletecomponent from './DeletePatient.vue';
export default {
    components:{
      delete:deletecomponent,BModal,BButton,patientform
    },
    directives:{
      'b-modal':VBModal
    },
    data(){
        return{
          modal: 'create',
          patient:{
                name: null,
                address: null,
                city: null,
                phone_number: null,
                dob: null,
                gender: 'Male',
            },
          errors:{},
          columns: ['id','name','dob' ,'phone_number','created_at','action'],
          patients:[],
          options: {
            // skin:'table table-hover table-borderless',
              sortIcon: {
            base : 'fa',
            is: 'fa-sort',
            up: 'fa-sort-up',
            down: 'fa-sort-down'
           },
             templates: {
                erase: 'delete'
            },

          sortable:['id','name','dob' ,'gender','address','city','phone_number','created_at'],
          filterable:['id','name','dob' ,'gender','address','city','phone_number','created_at'],
         }
        }
    },
    methods:{
      testing(event){
        console.log(event.row.id)
      },
      deleterow(id){
        console.log('here')
        console.log(id)
        this.patients=this.patients.filter(p=>p.id!==id)
        console.log(id)
      },
      binddata(id){
       this.patient = this.patients.find((p)=>p.id === id)
      },
      resetpatient(){
        this.patient=patientmodel()
      },
       saveUser(){
            axios.post('patients', this.patient)
            .then( (response) => {
                this.$toasted.show('Success !')
                this.$router.push('/patients')
                this.fetchData()
                this.resetpatient()
            })
            .catch((error) => {
                this.errors=error.response.data;
                console.log(error.response.data);
            });
        },
      saveEditedUser(){
            axios.put(`patients/${this.patient.id}`, this.patient)
            .then( (response) => {
            this.$toasted.show('Success !')
            this.$router.push('/patients')
            console.log(response.data);
            })
            .catch((error) => {
                this.errors=error.response.data;
                console.log(error.response.data);
            });
      },
      fetchData(){
        axios.get('patients/')
        .then((res)=>{
            this.patients=res.data
            console.log(this.patients)
        })
        .catch((err)=>{
            console.log(err)
        })
      }
    },
    mounted(){
    this.fetchData()
    
    }
}
</script>