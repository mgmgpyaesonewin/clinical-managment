<template>
    <div>
    <b-modal hide-footer :id="id" title="Information of A Consultation">
     <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <form class="form-material form-horizontal">
                    <div class="form-group">
                        <div class="row mx-0">
                             <label class="col-md-6 " for="example-email"> Doctor
                        </label>
                        <label class="col-md-6 " for="example-email"> {{$store.state.user.data.name}}
                        </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> Name
                        </label>
                        <div class="col-md-12">
                            <input type="text" v-model="problem.name" :class="{'is-invalid':  errors.name ? true : false}" class="form-control" placeholder="Enter Consult Term">
                            <div class="invalid-feedback">
                                {{errors.name && errors.name[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> Code 
                        </label>
                        <div class="col-md-12">
                            <input type="text" v-model="problem.code" :class="{'is-invalid':  errors.code ? true : false}" class="form-control" placeholder="Enter Consult value">
                            <div class="invalid-feedback">
                                {{errors.code && errors.code[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mx-0">
                             <label class="col-md-6 " for="example-email"> Type
                        </label>
                            <select class="col-md-6 form-control" :class="{'is-invalid':  errors.code ? true : false}"
                             v-model="problem.type" id="">
                                <option v-for="option in typeoption" :key="option" :value="option">{{option}}</option>
                            </select>
                              <div class="col-md-12 ml-2 invalid-feedback">
                                {{errors.type && errors.type[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row mx-0">
                             <label class="col-md-6 " for="example-email"> status
                        </label>
                            <select class="col-md-6 form-control" :class="{'is-invalid':  errors.status ? true : false}"
                             v-model="problem.status" id="">
                                <option v-for="option in statusoption" :key="option" :value="option">{{option}}</option>
                            </select>
                              <div class="ml-2 invalid-feedback">
                                {{errors.status && errors.status[0]}}
                            </div>
                        </div>
                    </div>
                    
                     <div v-if="checkstatus()" class="form-group">
                        <div class="row mx-0">
                             <label class="col-md-6 " for="example-email"> Start date
                        </label>
                         <label class="col-md-6 " for="example-email"> End date
                        </label>
                            <div class="col-md-6">
                             <date-picker
                            :error.sync="errors.start_time"
                            :date.sync="problem.start_time"
                            placeholder="Problem's start date"
                            @testing="setstartdate($event)"
                            />
                             <div class=" invalid-feedback">
                                {{errors.start_time && errors.start_time[0]}}
                            </div>
                            </div>

                            <div class="col-md-6">
                             <date-picker2
                            placeholder="Problem's end date"
                            :error.sync="errors.end_time"
                            :endate.sync="problem.end_time"
                            @enddate="setenddate($event)"
                            
                            />
                             <div class=" invalid-feedback">
                                {{errors.end_time && errors.end_time[0]}}
                            </div>
                            </div>
 
                        </div>
                    </div>
                    <div class="col-12  text-center">                 
                       <button @click.prevent="formsubmit()" type="submit" class="btn  btn-info waves-effect waves-light m-r-10">Submit</button>            
                    </div>
                        </form>
            </div>
        </div>
    </div>
  </b-modal>

    </div>
</template>
<script>
import datepicker from '../NewDatepicker';
import datepicker2 from '../datepicker2';

import timepicker from '../Timepicker'
import { BModal, VBModal } from 'bootstrap-vue'

export default {
    props:['problem','errors','id','typeoption','statusoption'],
    components:{
        BModal,
        datePicker:datepicker,
        datePicker2:datepicker2,
        timepicker
    },
    methods: {
    setstartdate(event){
        console.log('start')
        this.problem.start_time=event
    },
    setenddate(event){
        console.log('end')
        this.problem.end_time=event
    },
    checkstatus(){
        return this.problem.status==='Active';
    },
    formsubmit(){
        console.log(this.problem)
    this.$emit('submitform');
    }  
    },
    mounted(){
        console.log(this.problem)
    }
    
}
</script>