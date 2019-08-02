<template>
     <div class="col-sm-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Patients's Information</h5>
                <form class="form-material form-horizontal">
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> Name </span>
                        </label>
                        <div class="col-md-12">
                            <input type="text" v-model="patient.name" class="form-control" placeholder="Enter Patient Name">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> DOB </span>
                        </label>
                        <div class="col-md-12">
                            <input type="text" v-model="patient.dob" class="form-control" placeholder="Enter Patient Date of Birth">
                        </div>
                    </div>
                     <div class="form-group">
                        <div class="col-md-12">
                            <input type="radio" id="one" value="Male" v-model="patient.gender">
                            <label for="one">Male</label>
                            <input type="radio" id="two" value="Female" v-model="patient.gender">
                            <label for="two">Female</label>
                        </div>
                    </div>
                   <div class="form-group">
                        <label class="col-md-12" for="example-email"> Phone No: </span>
                        </label>
                        <div class="col-md-12">
                            <input type="text" v-model="patient.phone_number" class="form-control" placeholder="Enter Patient Phone No:">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> City </span>
                        </label>
                        <div class="col-md-12">
                            <input type="text" v-model="patient.city" class="form-control" placeholder="Enter City of Patient">
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-email"> Address </span>
                        </label>
                        <div class="col-md-12">
                            <textarea class="form-control" placeholder="Enter Patient Address" id=""  v-model="patient.address"  cols="20" rows="5"></textarea>
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
    props:['patient'],
    methods: {
        formsubmit(){
            axios.post('/api/patients', this.patient)
            .then( (response) => {
                console.log(response.data);
            })
            .catch((error) => {
                console.log(error.response.data);
            });
        }
    },
}
</script>