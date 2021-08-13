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
                        <label class="col-md-12" for="example-email"> Term
                        </label>
                        <div class="col-md-12">
                            <input type="text" v-model="invest.term" :class="{'is-invalid':  errors.term ? true : false}" class="form-control" placeholder="Enter Consult Term">
                            <div class="invalid-feedback">
                                {{errors.term && errors.term[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-group-override ">
                        <label class="col-md-12" for="example-email"> Code 
                        </label>
                        <div class="col-md-12">
                            <codepicker
                            :class="{'is-invalid':  errors.code ? true : false}" 
                            :code.sync="invest.code">
                            </codepicker>
                            <div class="invalid-feedback">
                                {{errors.code && errors.code[0]}}
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
<style lang="css">
.form-group-override {
  overflow: unset !important;
}
</style>
<script>
import datepicker from '../NewDatepicker';
import codepicker from '../Codepicker'
import timepicker from '../Timepicker'
import { BModal, VBModal } from 'bootstrap-vue'

export default {
    props:['invest','errors','id'],
    components:{
        BModal,
        codepicker,
        datePicker:datepicker,
        timepicker
    },

    methods: {
      formsubmit(){
       console.log(this.invest)
       this.$emit('submitform');
      }  
    },
    mounted(){
        // console.log(this.invest.term)
    }
    
}
</script>