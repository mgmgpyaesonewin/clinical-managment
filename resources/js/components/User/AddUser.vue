<template>
    <div>
      <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Add User</h4>
        </div>
        <div class="col-md-7 col-12  align-self-center text-right">
          <div class="d-flex justify-content-end align-items-center">
            <breadcrum />
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <user-form
          :errors="errors"
          :user.sync="user"
          @formsubmit="formsubmit()"
        />
      </div>
    </div>
</template>

<script>
import UserForm from './UserForm'
export default {
    components:{
        'user-form': UserForm
    },
    data(){
        return {
            user:{
                name: null,
                address: null,
                city: null,
                phone_number: null,
                dob: null,
                gender: 'Male',
            },
            errors:{}
        }
    },
    methods:{
         formsubmit(){
            axios.post('patients', this.patient)
            .then( (response) => {
                this.$toasted.show('Success !')
                // this.$router.push('/patients')
            })
            .catch((error) => {
                this.errors=error.response.data;
                console.log(error.response.data);
            });
        }
    },
    mounted() {
    },
}
</script>