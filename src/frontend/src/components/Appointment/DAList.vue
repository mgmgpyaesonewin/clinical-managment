<template>
    <div>
            <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Appointment</h4>
      </div>
      <div class="col-md-7 col-7 col-sm-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
          <breadcrum />
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row d-flex justify-content-center">
              <h4 class="card-title">Search Appointment</h4>
            </div>
            <br />
            <div class="row">
              <label class="col-md-1 col-form-label d-flex justify-content-end">Date :</label>
              <div class="col-md-4">
                <date-picker  @update-date="searchAppointment($event)"></date-picker>
              </div>
              <label class="col-md-1 col-form-label d-flex justify-content-end">Doctor :</label>
              <div class="col-md-4">
               <input class="form-control" type="text" disabled v-model="$store.state.user.data.name">
              </div>
              
            </div>
          </div>
        </div>
      </div>
    </div>
    <appointment
    :appo.sync="allappoint"
    />
    </div>
</template>
<script>
import DatePicker from "../DatePicker";
import appointment from "./BookedAlist"

export default {
    components:{
        DatePicker,
        appointment
    },
    data(){
        return{
            value:null,
            allappoint:[],
            updateDate:null
        }
    },
    methods:{
        searchAppointment(event){
            var date=moment(event).format('YYYY-MM-DD')
            this.updateDate=date
            axios.get(`appointments?id=${this.$store.state.user.data.id}&date=${this.updateDate}`)
            .then((res)=> {
                this.allappoint=res.data
                console.log(this.allappoint)
            })
            .catch(err=>console.log(err))
    
        }
    },
  
}
</script>