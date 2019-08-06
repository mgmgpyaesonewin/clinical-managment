<template>
     <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User's Information</h5>
                <form class="form-material form-horizontal">
                    <div class="form-group">
                        <label class="col-md-12" for="example-email">Name</label>
                        <div class="col-md-12">
                            <input type="text" v-model.number="user.name" :class="{'is-invalid':  errors.name ? true : false}" class="form-control" placeholder="Enter User Name">
                            <div class="invalid-feedback">
                                {{errors.name && errors.name[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email">Email</label>
                        <div class="col-md-12">
                            <input type="text" v-model.number="user.email" :class="{'is-invalid':  errors.email ? true : false}" class="form-control" placeholder="Enter User Email">
                            <div class="invalid-feedback">
                                {{errors.email && errors.email[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email">NRC</label>
                        <div class="col-md-12">
                            <input type="text" v-model.number="user.nrc" :class="{'is-invalid':  errors.nrc ? true : false}" class="form-control" placeholder="Enter User NRC">
                            <div class="invalid-feedback">
                                {{errors.nrc && errors.nrc[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email">DOB</label>
                        <div class="col-md-12">
                            <input type="text"  :class="{'is-invalid':  errors.dob ? true : false}" v-model="user.dob" class="form-control" placeholder="Enter User Date of Birth">
                             <div class="invalid-feedback">
                               {{errors.dob && errors.dob[0]}}
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-12 mb-2" for="example-email">Gender</label>
                        <div class="col-md-12 row ml-2">
                            <div class="custom-control custom-radio">
                                <input name="gender" type="radio" id="one" value="Male" v-model="user.gender" checked class="custom-control-input">
                                <label for="one" class="custom-control-label">Male</label>
                            </div>
                            <div class="custom-control custom-radio ml-3">
                                <input name="gender" type="radio" id="two" value="Female" v-model="user.gender" class="custom-control-input">
                                <label for="two" class="custom-control-label">Female</label>
                            </div>
                        </div>
                    </div>
                   <div class="form-group">
                        <label class="col-md-12" for="example-email">Phone Number</label>
                        <div class="col-md-12">
                            <input type="text"  :class="{'is-invalid':  errors.phone_number ? true : false}" v-model="user.phone_number" class="form-control" placeholder="Enter User Phone No:">
                             <div class="invalid-feedback">
                               {{errors.phone_number && errors.phone_number[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email">Organization</label>
                        <div class="col-md-12">
                            <input  :class="{'is-invalid':  errors.organization ? true : false}" type="text" v-model="user.organization" class="form-control" placeholder="Enter Organization of Patient">
                           <div class="invalid-feedback">
                                {{errors.organization && errors.organization[0]}}
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-email">Address</label>
                        <div class="col-md-12">
                           <textarea  :class="{'is-invalid':  errors.address ? true : false}" class="form-control" placeholder="Enter User Address" id=""  v-model="user.address"  cols="20" rows="5"></textarea>
                           <div class="invalid-feedback">
                                {{errors.address && errors.address[0]}}
                            </div>
                        </div>
                    </div>
                    <button @click.prevent="formsubmit()" type="submit" class="btn btn-info waves-effect waves-light m-r-10">Submit</button>
                    <button type="submit" class="btn btn-inverse waves-effect waves-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['user','errors'],
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
    }
}
</script>