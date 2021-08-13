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
                        <label class="col-md-12" for="example-email"> Date 
                        </label>
                        <div class="col-md-12">
                        <datepicker
                            placeholder="Problem's end date"
                            :error.sync="errors.date"
                            :date.sync="session.date"
                            :multi='id'
                            @testing="($event)=> session.date=$event"
                            
                            />        <div class="invalid-feedback">
                                {{errors.date && errors.date[0]}}
                            </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-email"> Start Time 
                        </label>
                        <div class="col-md-12">
                            <timepicker
                            :error="errors.start_time"
                            v-model="session.start_time"
                            name='start_time'
                            @testing="($event)=>session.start_time=$event"
                            />
                            <div class="invalid-feedback">
                                {{errors.start_time && errors.start_time[0]}}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-email"> End Time 
                        </label>
                        <div class="col-md-12">
                            <timepicker
                              name='end_time'
                              v-model="session.end_time"
                            @testing="($event)=>session.end_time=$event"
                            :error="errors.end_time"
                            />                            
                            <div class="invalid-feedback">
                                {{errors.end_time && errors.end_time[0]}}
                            </div>
                        </div>
                    </div>
                       <div class="form-group">
                        <label class="col-md-12" for="example-email"> Interval
                        </label>
                        <div class="col-md-12">
                         <div class="col-md-12">
                            <input type="number" v-model.number="session.interval" :class="{'is-invalid':  errors.interval ? true : false}" class="form-control" placeholder="Enter Consult value">
                            <div class="invalid-feedback">
                                {{errors.interval && errors.interval[0]}}
                            </div>
                        </div>
                        </div>
                    </div>
                     <div class="form-group">
                        <label class="col-md-12" for="example-email"> Comment
                        </label>
                        <div class="col-md-12">
                         <div class="col-md-12">
                            <input type="text" v-model="session.cmt" :class="{'is-invalid':  errors.cmt ? true : false}" class="form-control" placeholder="Enter Consult value">
                            <div class="invalid-feedback">
                                {{errors.cmt && errors.cmt[0]}}
                            </div>
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
<script>
function getTimeStops({ start_time, end_time, interval, date, doctor_id }) {
  var startTime = moment(start_time, "HH:mm");
  var endTime = moment(end_time, "HH:mm");

  //   if( endTime.isBefore(startTime) ){
  //     endTime.add(1, 'day');
  //   }

  var timeStops = [];

  while (startTime.isBefore(endTime)) {
    timeStops.push({
      date,
      doctor_id,
      booked: false,
      time: new moment(startTime).format("HH:mm")
    });
    startTime.add(interval, "minutes");
  }
  return timeStops;
}

import datepicker from '../multidatepicker';
import timepicker from '../Timepicker1'
import { BModal, VBModal } from 'bootstrap-vue'

export default {
  props: ["session", "errors", "id"],
  components: {
    BModal,
    datepicker,
    timepicker2: timepicker,
    timepicker
  },

  methods: {
    formsubmit() {
      const start = moment(this.session.start_time, "HH:mm");
      const end = moment(this.session.end_time, "HH:mm");
      console.log(start);
      console.log(end);
      // const check = start.isBefore(end,'hour')
      this.session.intervals = getTimeStops(this.session);
      this.$emit("submitform");
    }
  },
  mounted() {
    // console.log(this.invest.term)
  }
};
</script>