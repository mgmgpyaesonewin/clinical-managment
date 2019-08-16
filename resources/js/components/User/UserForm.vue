<template>
  <b-modal hide-footer  :id="this.modal" title="User's Information">
           <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"></h5>
                <form class="form-material form-horizontal">
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> Name </label>
                        <div class="col-md-12">
                            <input type="text" v-model="user.name" :class="{'is-invalid':  errors.name ? true : false}" class="form-control" placeholder="Enter User Name">
                            <div class="invalid-feedback">
                                {{errors.name && errors.name[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> DOB </label>
                        <div class="col-md-12">
                            <date-picker
                                :error="errors.dob"
                                :date.sync="user.dob"
                            />
                             <div class="invalid-feedback">
                               {{ errors.dob && errors.dob[0] }}
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <div class="col-md-12 ">
                            <div class="form-control">
                            <input name="rad"  type="radio" id="one" value="Male" v-model="user.gender">
                            <label checfor="one">Male</label>
                            <input name="rad" type="radio" id="two" value="Female" v-model="user.gender">
                            <label for="two">Female</label>
                            </div>
                        </div>
                    </div>
                   <div class="form-group">
                        <label class="col-md-12" for="example-email"> Phone No: </label>
                        <div class="col-md-12">
                            <input type="text"  :class="{'is-invalid':  errors.phone_number ? true : false}" v-model="user.phone_number" class="form-control" placeholder="Enter Patient Phone No:">
                             <div class="invalid-feedback">
                               {{errors.phone_number && errors.phone_number[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> City </label>
                        <div class="col-md-12">
                            <input  :class="{'is-invalid':  errors.city ? true : false}" type="text" v-model="user.city" class="form-control" placeholder="Enter City of Patient">
                           <div class="invalid-feedback">
                                {{errors.city && errors.city[0]}}
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-email"> Address </label>
                        <div class="col-md-12">
                            
                            <textarea  :class="{'is-invalid':  errors.address ? true : false}" class="form-control" placeholder="Enter Patient Address" id=""  v-model="patient.address"  cols="20" rows="5"></textarea>
                           <div class="invalid-feedback">
                                {{errors.address && errors.address[0]}}
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

</template>
<style lang="css">
    .bootstrap-datetimepicker-widget{
        background-color: black !important;
        z-index: 9040!important;
    }
</style>
<script>

import { BModal, VBModal,BButton } from 'bootstrap-vue'
import datepicker from './../DatePicker'
export default {
    components:{
        BModal, 
        datePicker:datepicker
    },
    props:['user','errors','modal'],
    data(){
        return{
        }
    },
    methods: { 
        formsubmit(){
            this.$emit('formsubmit')
        }
       
    },
    mounted(){
        this.$root.$on('bv::modal::show', (bvEvent, modalId) => {
            if(modalId==='create'){
                this.$emit('resetpatient')
            }
    })
    }
}
</script>