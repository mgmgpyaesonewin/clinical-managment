<template>
  <div>
    <b-modal hide-footer :id="id" title="Information of the Medication">
      <div class="col-sm-12">
        <form class="form-material form-horizontal">
          <div class="form-group">
            <div class="row mx-0">
              <label class="col-md-6" for="example-email">Doctor</label>
              <label class="col-md-6" for="example-email">{{$store.state.user.data.name}}</label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12" for="example-email">Drug</label>
            <div class="col-md-12">
              <input
                type="text"
                v-model="medication.drug"
                :class="{'is-invalid':  errors.drug ? true : false}"
                class="form-control"
                placeholder="Enter Drug Name"
              />
              <div class="invalid-feedback">{{errors.drug && errors.drug[0]}}</div>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-12" for="example-email">Dosage</label>
            <div class="col-md-12">
              <input
                type="text"
                v-model="medication.dosage"
                :class="{'is-invalid':  errors.dosage ? true : false}"
                class="form-control"
                placeholder="Dosage"
              />
              <div class="invalid-feedback">{{errors.dosage && errors.dosage[0]}}</div>
            </div>
          </div>
          <div class="form-group">
            <div class="row mx-0">
              <div class="col-6">
                <label for="example-email">Quantity</label>
              </div>
              <div class="col-6">
                <input
                  min="1"
                  type="number"
                  v-model="medication.qty"
                  :class="{'is-invalid':  errors.qty ? true : false}"
                  class="form-control"
                  placeholder="Dosage"
                />
                <div class="invalid-feedback">{{errors.qty && errors.qty[0]}}</div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row mx-0">
              <div class="col-6">
                <label for="example-email">Duration</label>
              </div>
              <div class="col-6">
                <input
                  type="number"
                  min="1"
                  v-model="medication.duration"
                  :class="{'is-invalid':  errors.duration ? true : false}"
                  class="form-control"
                  placeholder="x Per Day"
                />
                <div class="invalid-feedback">{{errors.duration && errors.duration[0]}}</div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="row mx-0">
              <label class="col-md-6" for="example-email">Type</label>
              <select
                class="col-md-6 form-control"
                :class="{'is-invalid':  errors.type ? true : false}"
                v-model="medication.type"
                id
              >
                <option v-for="option in medicationtype" :key="option" :value="option">{{option}}</option>
              </select>
              <div class="ml-2 invalid-feedback">{{errors.type && errors.type[0]}}</div>
            </div>
          </div>
          <div class="col-12 text-center">
            <button
              @click.prevent="formsubmit()"
              type="submit"
              class="btn btn-info waves-effect waves-light m-r-10"
            >Submit</button>
          </div>
        </form>
      </div>
    </b-modal>
  </div>
</template>
<script>
import datepicker from "../NewDatepicker";
import datepicker2 from "../datepicker2";

import timepicker from "../Timepicker";
import { BModal, VBModal } from "bootstrap-vue";

export default {
  props: ["medication", "errors", "id", "medicationtype"],
  components: {
    BModal,
  },
  computed: {
    statuschange() {
      return this.medication.status;
    }
  },
  watch: {
    statuschange(val) {
      this.medication.start_time = null;
      this.medication.end_time = null;
    }
  },
  methods: {
    checkforduration() {
      return this.medication.status === "Active medication";
    },
    setstartdate(event) {
      console.log("start");
      this.medication.start_time = event;
    },
    setenddate(event) {
      console.log("end");
      this.medication.end_time = event;
    },
    checkstatus() {
      return (
        this.medication.status === "Past/Ended medication" ||
        this.medication.duration === "custom"
      );
    },
    formsubmit() {
      this.$emit("submitform");
    }
  },
  mounted() {}
};
</script>