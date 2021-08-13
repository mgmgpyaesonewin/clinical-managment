<template>
  <div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="row d-flex justify-content-center">
              <aheader :current="current" @handle="handle($event)"/>              
            </div>
            <br />
            <div class="row">
              <label class="col-md-1 col-form-label d-flex justify-content-end">Date :</label>
              <div class="col-md-2">
                <date-picker  startDate="" :ename="'daydate'" @daydate="updateDate"></date-picker>
              </div>
              <div class="col-md-2">
                <date-picker startDate=""  :ename="'weekdate'" @weekdate="updateweekdate"></date-picker>
              </div>
              <label class="col-md-1 col-form-label d-flex justify-content-end">Doctor :</label>
              <div class="col-md-3">
                <multiselect
                  v-model="value"
                  :options="users"
                  track-by="name"
                  label="name"
                  :multiple="true"
                  placeholder="Choose a doctor"
                ></multiselect>
              </div>
              <div class="col-md-2">
                <button class="btn btn-info btn-block" type="button" @click="searchAppointment">
                  <span>
                    <i class="fa fa-search"></i> Search
                  </span>
                </button>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <div class="row">
           <div   :key="index" v-for="(s,index) in sessions"  class="col-sm-4">
            <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{index}}({{changeformat(index)}})</h5>
                <div :key="ds" v-for="(d,ds) in s" class="card-text">
                  <div class="row">
                    <div class="col-5">
                      <b-progress  :value="d.count"
                    :max="d.maxcount" variant="success"
                     show-progress ></b-progress>
                    </div>
                
                    <div class="col-5">
                    <span >{{d.doctor.name}}</span  >
                    </div>
                  </div>
                </div>
            </div>
            </div>
        </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import Multiselect from "vue-multiselect";
import DatePicker from "../AppointmentDatepicker";
import aheader from "./appointmentheader";
import {BProgress}  from "bootstrap-vue";
export default {
  props:['current'],
  name: "AppointmentView",
  components: {
    "date-picker": DatePicker,
    aheader,BProgress,
    multiselect: Multiselect
  },
  data() {
    return {
      date: null,
      weekdate:null,
      countarray:null,
      value: [],
      users: [],
      sessions: []
    };
  },
  methods: {
    changeformat(time){
        return moment(time).format('dddd');
    },
    handle(event){
      this.$emit("update:current",event)
    },
    updateweekdate(date){
      this.weekdate = moment(date).format("YYYY-MM-DD");
    },
    updateDate: function(date) {
      this.date = moment(date).format("YYYY-MM-DD");
    },
    changearrayformat(data){
      var newarray={};
          Object.keys(data).forEach((d)=>{
            console.log(d)
            newarray[d]={}
              Object.keys(data[d]).forEach((ses)=>{
                console.log(ses)
                var count=0;
                var doctor=null
                data[d][ses].forEach((si)=>{
                    if(si.booked==1){
                      count++;
                    }
                    console.log(si.booked)
                doctor=si.doctor
                })
              newarray[d][ses]={count,maxcount:data[d][ses].length,doctor}
              })
          })

      return newarray;
    },
    searchAppointment() {
        var idarray= this.value.map((v)=>{
                return v.id
        })
      axios.get("week", {
          params: {
            id: idarray,
            fromdate: this.date,
            todate:this.weekdate
          }
        })
        .then(({ data }) => {
          this.sessions=this.changearrayformat(data);
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
  mounted() {
    axios
      .get("users")
      .then(({ data }) => {
        this.users = data.map(({ id, name }) => ({ id, name }));
      })
      .catch(err => {
        console.log(err);
      });
  }
};
</script>

<style src="vue-multiselect/dist/vue-multiselect.min.css"></style>
<style>
.multiselect__placeholder {
  color: #adadad;
  display: inline-block;
  margin-bottom: 0px;
  padding-top: 0px;
}
</style>