<template>
    <div>
    <div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Add Patient</h4>
    </div>
    <div class="col-md-7 col-12  align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
           <breadcrum />
        </div>
    </div>
    </div>
        <!-- {{patient.name}} -->
        <div class="row justify-content-center">
            <patientform
            :errors="errors"
            :patient.sync="patient"
            @formsubmit="formsubmit()"
            />
        </div>
    </div>
</template>

<script>
import patientform from './PatientForm'
export default {
    components:{
        patientform
    },
    data(){
        return {
            patient:{
                name: null,
                address: null,
                city: null,
                phone_number: null,
                dob: null,
                gender: 'Male',
            },
            errors:{},
        }
    },
    methods:{
        formsubmit(){
            const id = this.$route.params.id
            axios.put(`patients/${id}`, this.patient)
            .then( (response) => {
            this.$toasted.show('Success !')
            this.$router.push('/patients')
            console.log(response.data);
            })
            .catch((error) => {
                this.errors=error.response.data;
                console.log(error.response.data);
            });
        }
    },
     mounted() {
        const id = this.$route.params.id
        console.log(id)
        axios.get(`patients/${id}`)
        .then((res)=>{
            this.patient= res.data
            console.log(this.patient)
        })
        .catch((err)=>{
            console.log(err)
        })
        },
}
</script>