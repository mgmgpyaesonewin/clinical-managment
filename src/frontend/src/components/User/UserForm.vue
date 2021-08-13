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
                                @testing="setdate($event)"
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
                            <input type="text"  :class="{'is-invalid':  errors.phone ? true : false}" v-model="user.phone" class="form-control" placeholder="Enter User Phone No:">
                             <div class="invalid-feedback">
                               {{errors.phone && errors.phone[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> NRC </label>
                        <div class="col-md-12">
                            <input  :class="{'is-invalid':  errors.nrc ? true : false}" type="text" v-model="user.nrc" class="form-control" placeholder="Enter NRC of User">
                            <div class="invalid-feedback">
                                {{errors.nrc && errors.nrc[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> Organization </label>
                        <div class="col-md-12">
                            <input  :class="{'is-invalid':  errors.organization ? true : false}" type="text" v-model="user.organization" class="form-control" placeholder="Enter Organization of User">
                            <div class="invalid-feedback">
                                {{errors.address && errors.address[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> Email </label>
                        <div class="col-md-12">
                            <input  :class="{'is-invalid':  errors.email ? true : false}" type="text" v-model="user.email" class="form-control" placeholder="Enter Email of User">
                            <div class="invalid-feedback">
                                {{errors.email && errors.email[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email">Password </label>
                        <div class="col-md-12">
                            <input :class="{'is-invalid':  errors.password ? true : false}" type="password" v-model="user.password" class="form-control" placeholder="Enter Password of User">
                            <div class="invalid-feedback">
                                {{errors.email && errors.password[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email">Role</label>
                        <div class="col-md-12">
                            <select class="custom-select col-12" id="inlineFormCustomSelect" v-model="user.role_id">
                                <option selected>Choose...</option>
                                <option :value="role.id" v-for="role in roles">{{ role.name }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> Address </label>
                        <div class="col-md-12">
                            <textarea  :class="{'is-invalid':  errors.address ? true : false}" class="form-control" placeholder="Enter User Address" id=""  v-model="user.address"  cols="20" rows="5"></textarea>
                            <div class="invalid-feedback">
                                {{errors.address && errors.address[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                    <input v-model="user.is_doctor"  class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                    <label class="form-check-label text-info" for="defaultCheck1">
                       Section Holder
                    </label>
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
import datepicker from './../NewDatepicker'
export default {
    components:{
        BModal, 
        datePicker:datepicker
    },
    props:['user','errors','modal'],
    data(){
        return{
            roles: [],
        }
    },
    methods: { 
        setdate(event){
            this.user.dob=event
        },
        formsubmit(){
            this.$emit('formsubmit')
        }
    },
    mounted(){
        this.$root.$on('bv::modal::show', (bvEvent, modalId) => {
            axios
                .get('roles/')
                .then(res => this.roles = res.data)
                .catch(err => console.log(err));
            if(modalId === 'create'){
                this.$emit('resetpatient')
            }
        });
    }
}
</script>