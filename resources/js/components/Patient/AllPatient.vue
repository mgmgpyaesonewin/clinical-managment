<template>
    <div>
        <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Information Of All Patients</h4>
    </div>
      <div class="col-md-7 col-12  align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
           <breadcrum />
            <router-link type="button" to="/patients/add" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> New Patient</router-link>
        </div>
    </div>
    </div>
            <div class="col-12 ">


<div id="app">
  <v-client-table :columns="columns" :data="patients" :options="options">
    <div slot="action" slot-scope="props" >
    <router-link  :to="'/patients/edit/'+props.row.id" class="fa fa-edit"></router-link>
    <delete :patientdata.sync='patients' :index='props.index' :data="props.row"></delete>
      </div>
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

    
</style>
<script>
import Vue from 'vue';
import deletecomponent from './DeletePatient.vue';
export default {
    components:{
      delete:deletecomponent
    },
    data(){
        return{
          columns: ['id','name','dob' ,'gender','address','city','phone_number','created_at','action'],
          patients:[],
          options: {
              sortIcon: {
            base : 'fa',
            is: 'fa-sort',
            up: 'fa-sort-up',
            down: 'fa-sort-down'
           },
             templates: {
                erase: 'delete'
            },

          sortable:['name','dob' ,'gender','address','city','phone_number','created_at'],
          filterable:['name','dob' ,'gender','address','city','phone_number','created_at'],
         }
        }
    },
    mounted(){
      console.log(this.$toasted)
        axios.get('patients/')
        .then((res)=>{
            this.patients=res.data
            console.log(this.patients)
        })
        .catch((err)=>{
            console.log(err)
        })
    }
}
</script>