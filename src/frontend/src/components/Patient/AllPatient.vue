<template>
  <div>
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Information Of All Patients</h4>
      </div>
      <div class="col-md-7 col-7 col-sm-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
          <breadcrum />
          <button
            type="button"
            v-b-modal.create
            class="btn btn-info d-lg-block m-l-15"
            v-if="$can('create patients')"
          >
            <i class="fa fa-plus-circle"></i> New Patient
          </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-body">
            <patientform
              :errors.sync="errors"
              :patient.sync="this.patient"
              modal="create"
              @resetpatient="resetpatient()"
              @formsubmit="saveUser()"
            />
            <patientform
              :errors.sync="errors"
              :patient.sync="patient"
              modal="edit"
              @formsubmit="saveEditedUser()"
            />
            <div class="col-12">
              <v-server-table
                ref="ptbl"
                :url="baseUrl+'/patients?hosid='+this.$store.state.user.data.hospital_id"
                :columns="columns"
                :options="options"
              >
                <div slot="action" slot-scope="props">
                  <span class="link--padding--horizontal span--action--primary">
                    <router-link :to="`/patients/detail/${props.row.id}`">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </router-link>
                  </span>
                  <span class="link--padding--horizontal span--action--success">
                    <a
                      href="#"
                      @click.prevent="binddata(props.row.id)"
                      v-b-modal.edit
                      class="fa fa-edit"
                      v-if="$can('edit patients')"
                    ></a>
                  </span>
                  <span class="link--padding--horizontal span--action--danger">
                    <delete
                      @deleteRow="deleterow($event)"
                      :patients.sync="patients"
                      :index="props.index"
                      :data="props.row"
                      v-if="$can('delete patients')"
                    ></delete>
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
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang="css">
.table td,
.table th {
  padding: 0.5rem;
}
.table {
  /* padding:0 !important;
    margin:0 !important;
     */
  border: 0px;
  padding: 0;
  border-spacing: 0;
  margin: 0;
  border-collapse: collapse;
}
.VuePagination {
  justify-content: center;
  text-align: center;
}

.vue-title {
  text-align: center;
  margin-bottom: 10px;
}

.vue-pagination-ad {
  text-align: center;
}

.glyphicon.glyphicon-eye-open {
  width: 16px;
  display: block;
  margin: 0 auto;
}

th:nth-child(3) {
  text-align: left;
}

.VueTables__child-row-toggler {
  width: 16px;
  height: 16px;
  line-height: 16px;
  display: block;
  margin: auto;
  text-align: center;
}

.VueTables__child-row-toggler--closed::before {
  content: "+";
}

.VueTables__child-row-toggler--open::before {
  content: "-";
}

.modal-backdrop {
  background-color: #00000085 !important;
}

.link--padding--horizontal {
  padding: 0 0.5rem 0 0.5rem;
}

.span--action--primary > a {
  color: #2196f3;
}

.span--action--success > a {
  color: #4caf50;
}

.span--action--danger > a {
  color: #f44336;
}
</style>
<script>
var patientmodel = () => {
  return {
    name: null,
    address: null,
    city: null,
    nrc:null,
    type:1,
    phone_number: null,
    dob: null,
    gender: "Male"
  };
};
import { VBModal } from "bootstrap-vue";
import patientform from "./PatientForm";
import deletecomponent from "./DeletePatient.vue";

export default {
  name: "AllPatients",
  components: {
    delete: deletecomponent,
    patientform
  },
  directives: {
    "b-modal": VBModal
  },
  data() {
    return {
      modal: "create",
      patient: {
        name: null,
        address: null,
        city: null,
        nrc:null,
        phone_number: null,
        type:1,
        dob: null,
        gender: "Male"
      },
      errors: {},
      columns: ["id", "name", "dob", "phone_number","nrc", "created_at", "action"],
      patients: [],
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
  methods: {
    testing(event) {
      console.log(event.row.id);
    },
    deleterow(id) {
      this.patients = this.patients.filter(p => p.id !== id);
    },
    async binddata(id) {
      console.log(id);
      const { data } = await axios.get(`patients/${id}`);
      // console.log(data)
      this.patient = data;
      console.log(this.patient);
    },
    resetpatient() {
      this.patient = patientmodel();
    },
    saveUser() {
      const new_patient = {
        ...this.patient,
        user_id: this.$store.state.user.data.id,
        hospital_id: this.$store.state.user.data.hospital_id
      };
       this.$store.commit('setLoading',true)
      axios
        .post("patients", new_patient)
        .then(() => {
          this.$toasted.show("Success !");
          this.$refs.ptbl.getData();
          this.resetpatient();
        this.$store.commit('setLoading',false)

        })
        .catch(error => {
          this.errors = error.response.data;
          console.log(error.response.data);
          this.$store.commit('setLoading',false)
        });
    },
    saveEditedUser() {
             this.$store.commit('setLoading',true)
      axios
        .put(`patients/${this.patient.id}`, this.patient)
        .then(response => {
                  this.$store.commit('setLoading',false)
          this.$toasted.show("Success !");
          console.log(response.data);
        })
        .catch(error => {
                  this.$store.commit('setLoading',false)
          this.errors = error.response.data;
          console.log(error.response.data);
        });
    }
  }
};
</script>