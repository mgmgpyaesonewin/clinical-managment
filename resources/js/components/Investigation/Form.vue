<template>
    <div>
    <b-modal hide-footer title="Information of A Consultation">
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
                        <label class="col-md-12" for="example-email"> Title </span>
                        </label>
                        <div class="col-md-12">
                            <input type="text" v-model="consult.title" :class="{'is-invalid':  errors.title ? true : false}" class="form-control" placeholder="Enter Consult Title">
                            <div class="invalid-feedback">
                                {{errors.title && errors.title[0]}}
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <div class="row mx-0">
                             <label class="col-md-6" for="example-email"> Date
                        </label>
                        <label class="col-md-6" for="example-email"> Time
                        </label>
                        </div>
                       <div class="row mx-0">
                        <div class="col-md-6">
                            <date-picker
                            :error="errors.date"
                            :date.sync="consult.date"
                            @testing="consult.date=$event"
                            />
                             <div class="invalid-feedback">
                               {{errors.date && errors.date[0]}}
                            </div>
                        </div>
                         <div class="col-md-6">
                             <timepicker
                             :error="errors.time"
                             :time.sync="consult.time"
                               @testing="consult.time=$event"
                             />
                             <div class="invalid-feedback">
                               {{errors.time && errors.time[0]}}
                            </div>
                             

                        </div>
                       </div>
                       
                    </div> -->
                 
                     <div class="form-group">
                        <label class="col-md-12" for="example-email"> Comment
                        </label>
                        <div class="col-md-12">
                            
                            <textarea  :class="{'is-invalid':  errors.comment ? true : false}" class="form-control" placeholder="Enter consult Address" id=""  v-model="consult.comment"  cols="20" rows="5"></textarea>
                           <div class="invalid-feedback">
                                {{errors.comment && errors.comment[0]}}
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
import timepicker from '../Timepicker'
import { BModal, VBModal } from 'bootstrap-vue'

export default {
    components:{
        BModal,
        datePicker:datepicker,
        timepicker
    },
    data(){
        return{
            errors:{},
             consult:{
                comment:null,
                title:null,
                patient_id:this.$route.params.id
            },

        }
    },
    methods: {
      formsubmit(){
          console.log(this.consult)
          axios.post('consultations',this.consult)
          .then((res)=>{
                this.$toasted.show('Success !')
          })
          .catch((err)=>{
            this.errors=err.response.data;
            console.log(err.response.data)
          })
      }  
    },
    
}
</script>