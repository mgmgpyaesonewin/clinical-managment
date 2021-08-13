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
              <div class="col-md-4">
                <date-picker @update-date="updateDate"></date-picker>
              </div>
              <label class="col-md-1 col-form-label d-flex justify-content-end">Doctor :</label>
              <div class="col-md-4">
                <multiselect
                  v-model="value"
                  :options="users"
                  track-by="name"
                  label="name"
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
      <div class="col-md-4" v-for="(session, index) in sessions" :key="index">
        <div class="card border-info">
          <div class="card-header bg-info">
            <h4 class="m-b-0 text-white">{{ session.cmt }}</h4>
          </div>
          <div class="card-body">
            <session-list
              :session_id="session.id"
              :slots="session.slots"
              :patients="patients"
              v-on:book-appointment="bookAppointment"
            ></session-list>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
import Multiselect from "vue-multiselect";
import SessionList from "./SessionList";
import DatePicker from "../DatePicker";
import aheader from "./appointmentheader";

export default {
  props:['current'],
  name: "AppointmentView",
  components: {
    "date-picker": DatePicker,
    aheader,
    multiselect: Multiselect,
    "session-list": SessionList
  },
  data() {
    return {
      date: null,
      value: null,
      users: [],
      patients: [],
      sessions: []
    };
  },
  methods: {
    handle(event){
      this.$emit("update:current",event)
    },
    updateDate: function(date) {
      this.date = moment(date).format("YYYY-MM-DD");
    },
    searchAppointment() {
      axios
        .get("sessions", {
          params: {
            id: this.value.id,
            date: this.date
          }
        })
        .then(({ data }) => {
          this.sessions = data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    bookAppointment({ patient, session_id, session_interval }) {
      axios
        .post("appointments", {
          patient_id: patient.id,
          doctor_id: this.value.id,
          session_id: session_id,
          session_interval_id: session_interval
        })
        .then(({ data }) => {
          console.log(data);
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

    axios
      .get("patients/all")
      .then(({ data }) => {
        this.patients = data.map(({ id, name }) => ({ id, name }));
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