<template>
  <div class="col-12 "  @click="modalShow = !modalShow">
    <b-modal size="lg" v-model="modalShow" >
      <v-server-table
        ref="ptbl"
        :url="baseUrl+'/patients?hosid='+this.$store.state.user.data.hospital_id"
        :columns="columns"
        :options="options"
      >
        <div slot="action" slot-scope="props">
          <span class="link--padding--horizontal span--action--primary">
            <a @click.prevent="changePatient(props.row)" href="#">
              <i class="fa fa-eye" aria-hidden="true"></i>
            </a>
          </span>
        </div>
        <template slot="child_row" slot-scope="props">
          <div>
            <b>Address :</b>
            {{props.row.address}}
          </div>
          <div>
            <b>Gender :</b>
            {{props.row.gender}}
          </div>
          <div>
            <b>City :</b>
            {{props.row.city}}
          </div>
        </template>
      </v-server-table>
    </b-modal>
    <div v-if="$store.state.patient" class="row">
      <div class="col-12 tab patient--nav--selected">
        <span>
          <i class="ti-user"></i> &nbsp;Patient Info
        </span>
        <span>
          <label>Name:</label>
          <label>{{ $store.state.patient.name }}</label>
        </span>
        <span>
          <label>Age:</label>
          <label>{{Ageformat()}}</label>
        </span>
        <span>
          <label>NRC:</label>
          <label>12/SaKhaNa(N)082719</label>
        </span>
        <span>
          <label>Patient Code:</label>
          <label>PL-023142</label>
        </span>
      </div>
      <!-- <div class="col-3">
        <button class="btn btn-primary">Show Modal</button>
      </div>`` -->
    </div>
    <div v-else class="row">
      <div class="patient--nav--selected col-12">
        <span>
          <i class="ti-user"></i> Patient Info
        </span>
        <span>
          <label>Please Select A Patient</label>
        </span>
      </div>
      <!-- <div class="col-3">
          <patient-picker class="col-12 m" @change-patient="changePatient($event)" />
      </div> -->
    </div>
  </div>
</template>

<script>
import patientPicker from "./Patientpicker";
import { bus } from "../../eventbus";
import { BModal, VBModal } from "bootstrap-vue";
export default {
  data() {
    return {
      modalShow: false,
      columns: [
        "id",
        "name",
        "dob",
        "phone_number",
        "nrc",
        "created_at",
        "action"
      ],

      options: {
        perPage: 5,
        // skin:'table table-hover table-borderless',
        sortIcon: {
          base: "fa",
          is: "fa-sort",
          up: "fa-sort-up",
          down: "fa-sort-down"
        },
        templates: {
          erase: "delete"
        },
        sortable: ["id"],
        filterable: false
      }
    };
  },
  components: {
    patientPicker,
    BModal
  },
  directives: {
    "b-modal": VBModal
  },
  methods: {
    Ageformat() {
      return moment().diff(this.$store.state.patient.dob, "years");
    },
    changePatient(value) {
      this.$store.dispatch("savePatient", value);
      bus.$emit("changePatient");
      this.modalShow = !this.modalShow;
      this.$router.push(`/patients/detail/${this.$store.state.patient.id}`);
    }
  }
};
</script>

<style>
.patient--nav--selected {
  width: 100%;
  background-color: #01c0c8;
  padding: 1rem 1.25rem 0.5rem 1.25rem;
  margin-bottom: 1rem;
  border: 1px solid transparent;
  border-radius: 0.25rem;
}

.tab > span {
  color: #f1f1f1;
  width: 100px;
  margin: 10px;
  text-align: center;
}

.tab > span > label {
  padding: 0 0.2rem 0 0.2rem;
}
</style>