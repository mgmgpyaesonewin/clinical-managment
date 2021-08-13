<template>
  <div>
    <b-modal hide-footer :id="id" title="Problem Form">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <form class="form-material form-horizontal">
              <div class="form-group">
                <div class="row mx-0">
                  <label class="col-md-6" for="example-email">Doctor</label>
                  <label class="col-md-6" for="example-email">{{$store.state.user.data.name}}</label>
                </div>
              </div>
              <div class="form-group form-group-override">
                <label class="col-md-12" for="example-email">Code</label>
                <div class="col-md-12">
                  <codepicker @update-code="updateCode"></codepicker>
                  <div class="invalid-feedback">{{errors.code && errors.code[0]}}</div>
                </div>
              </div>
              <div class="form-group">
                <div class="row mx-0">
                  <label class="col-md-6" for="example-email">Type</label>
                  <select
                    class="col-md-6 form-control"
                    :class="{'is-invalid':  errors.code ? true : false}"
                    v-model="problem.type"
                    id
                  >
                    <option v-for="option in typeoption" :key="option" :value="option">{{option}}</option>
                  </select>
                  <div class="col-md-12 ml-2 invalid-feedback">{{errors.type && errors.type[0]}}</div>
                </div>
              </div>
              <div class="form-group">
                <div class="row mx-0">
                  <label class="col-md-6" for="example-email">status</label>
                  <select
                    class="col-md-6 form-control"
                    :class="{'is-invalid':  errors.status ? true : false}"
                    v-model="problem.status"
                    id
                  >
                    <option v-for="option in statusOption" :key="option" :value="option">{{option}}</option>
                  </select>
                  <div class="ml-2 invalid-feedback">{{errors.status && errors.status[0]}}</div>
                </div>
              </div>
              <div class="form-group">
                <div class="row mx-0">
                  <label class="col-md-6" for="example-email">Action</label>
                  <select
                    class="col-md-6 form-control"
                    :class="{'is-invalid':  errors.action ? true : false}"
                    v-model="problem.action"
                    id
                  >
                    <option v-for="option in actionOption" :key="option" :value="option">{{option}}</option>
                  </select>
                  <div class="ml-2 invalid-feedback">{{errors.action && errors.action[0]}}</div>
                </div>
              </div>
              <div v-if="checkforduration()" class="form-group">
                <div class="row mx-0">
                  <label class="col-md-6" for="example-email">Duration</label>
                  <select
                    class="col-md-6 form-control"
                    :class="{'is-invalid':  errors.duration ? true : false}"
                    v-model="problem.duration"
                    id
                  >
                    <option
                      v-for="option in durationOption"
                      :key="option"
                      :value="option"
                    >{{option}}</option>
                  </select>
                  <div class="ml-2 invalid-feedback">{{errors.duration && errors.duration[0]}}</div>
                </div>
              </div>
              <div v-if="checkstatus()" class="form-group">
                <div class="row mx-0">
                  <label class="col-md-6" for="example-email">Start date</label>
                  <label class="col-md-6" for="example-email">End date</label>
                  <div class="col-md-6">
                    <date-picker
                      :error.sync="errors.start_time"
                      :date.sync="problem.start_time"
                      placeholder="Problem's start date"
                      @testing="setstartdate($event)"
                    />
                    <div class="invalid-feedback">{{errors.start_time && errors.start_time[0]}}</div>
                  </div>

                  <div class="col-md-6">
                    <date-picker2
                      placeholder="Problem's end date"
                      :error.sync="errors.end_time"
                      :endate.sync="problem.end_time"
                      @enddate="setenddate($event)"
                    />
                    <div class="invalid-feedback">{{errors.end_time && errors.end_time[0]}}</div>
                  </div>
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
        </div>
      </div>
    </b-modal>
  </div>
</template>
<script>
import datepicker from "../NewDatepicker";
import codepicker from "../Codepicker";
import { BModal } from "bootstrap-vue";

export default {
  props: ["problem", "errors", "id"],
  data() {
    return {
      value: { code: "Code", title: "Term" },
      typeoption: ["minor", "significant"],
      actionoption: ["Combine", "Evolve", "Group"],
      statusOption: ["Active Problem", "Past/Ended Problem"],
      actionOption: ["Combine", "Evolve", "Group"],
      durationOption: [
        "7 days",
        "14 days",
        "28 days",
        "3 mon",
        "6 mon",
        "1 yr",
        "custom"
      ],
      selected: [],
      codes: []
    };
  },
  components: {
    BModal,
    codepicker,
    datePicker: datepicker,
    "date-picker2": datepicker
  },
  computed: {
    statuschange() {
      return this.problem.status;
    }
  },
  watch: {
    statuschange(val) {
      this.problem.start_time = null;
      this.problem.end_time = null;
    }
  },
  methods: {
    checkforduration() {
      return this.problem.status === "Active Problem";
    },
    setstartdate(event) {
      console.log("start");
      this.problem.start_time = event;
    },
    setenddate(event) {
      console.log("end");
      this.problem.end_time = event;
    },
    checkstatus() {
      return (
        this.problem.status === "Past/Ended Problem" ||
        this.problem.duration === "custom"
      );
    },
    formsubmit() {
      this.$emit("save-problem", this.problem);
    },
    fetchData() {
      axios
        .get("codes/")
        .then(({ data }) => {
          this.codes = data;
        })
        .catch(err => {
          console.log(err);
        });
    },
    nameWithLang({ code, title }) {
      return `${code} — [${title}]`;
    },
    pushValue() {
      this.selected.push(this.value);
    },
    updateCode(value) {
      this.problem.code = value;
    }
  },
  mounted() {
    this.fetchData();
  }
};
</script>
<style lang="css">
.form-group-override {
  overflow: unset !important;
}
</style>