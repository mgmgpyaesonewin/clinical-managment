<template>
    <div>
    <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Add Patient</h4>
    </div>
    <div class="col-md-7 col-12  align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
           <breadcrum />
            <button type="button" data-toggle="modal" data-target="#exampleModal" class="btn btn-info d-none d-lg-block m-l-15"><i class="fa fa-plus-circle"></i> Create New</button>
        </div>
    </div>
    </div>
        <!-- {{patient.name}} -->
        <div class="row justify-content-center">
            <patientform
            :patient.sync="patient"
            />
        </div>
    </div>
</template>

<script>
import breadcrum from '../breadcrum'
import patientform from './PatienForm'
export default {
    components:{
        patientform,breadcrum
    },
    data(){
        return {
            patient:{
                name: null,
                address: null,
                city: null,
                phone_number: null,
                dob: null,
                gender: null,
            }
        }
    },
    mounted() {
    console.log(this.$store.state.breadcrum);
    },
}
</script>