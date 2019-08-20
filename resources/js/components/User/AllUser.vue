<template>
  <div>
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Information Of All Users</h4>
      </div>
      <div class="col-md-7 col-7 col-sm-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
          <breadcrum />
          <button type="button" v-b-modal.create class="btn btn-info d-lg-block m-l-15">
            <i class="fa fa-plus-circle"></i> New User
          </button>
        </div>
      </div>
      <div class="row">
        <user-form
          :errors.sync="errors"
          :user.sync="this.user"
          modal="create"
          @resetpatient="resetpatient()"
          @formsubmit="saveUser()"
        />
        <!-- <user-form
          :errors.sync="errors"
          :patient.sync="patient"
          modal="edit"
          @formsubmit="saveEditedUser()"
        /> -->
      </div>
    </div>
    <div class="col-12">
      <div>
        <v-client-table
          @row-click="testing($event)"
          :columns="columns"
          :data="users"
          :options="options"
        >
          <div slot="action" slot-scope="props">
            <a href="#" @click.prevent="binddata(props.row.id)" v-b-modal.edit class="fa fa-edit"></a>
            <!-- <delete
              @deleteRow="deleterow($event)"
              :patients.sync="patients"
              :index="props.index"
              :data="props.row"
            ></delete> -->
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
        </v-client-table>
      </div>
    </div>
  </div>
</template>

<script>
let UserModel  = () => {
  return {
    name: null,
    address: null,
    dob: null,
    nrc: null,
    phone: null,
    organization: null,
    gender: "Male",
    email: null,
    password: null
  };
};

import { BModal, VBModal, BButton } from "bootstrap-vue";
import Vue from "vue";
import UserForm from "./UserForm";
import DeleteUser from "./DeleteUser.vue";
export default {
  components: {
    'delete-user': DeleteUser,
    BModal,
    BButton,
    'user-form': UserForm
  },
  directives: {
    "b-modal": VBModal
  },
  data() {
    return {
      modal: "create",
      user: {
        name: null,
        address: null,
        dob: null,
        nrc: null,
        phone: null,
        organization: null,
        gender: "Male",
        email: null,
        password: null
      },
      errors: {},
      columns: ["id", "name", "address", "dob", "nrc", "phone", "organization", "gender", "email", "created_at", "action"],
      users: [],
      options: {
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
        sortable: [
          "id", 
          "name", 
          "address", 
          "dob", 
          "nrc", 
          "phone", 
          "organization", 
          "gender", 
          "email", 
          "created_at"
        ],
        filterable: [
          "id",
          "name",
          "dob",
          "gender",
          "address",
          "city",
          "phone_number",
          "created_at"
        ]
      }
    };
  },
  methods: {
    testing(event) {
      console.log(event.row.id);
    },
    deleterow(id) {
      console.log("here");
      console.log(id);
      this.users = this.users.filter(p => p.id !== id);
      console.log(id);
    },
    binddata(id) {
      this.user = this.users.find(p => p.id === id);
    },
    resetpatient() {
      this.user = UserModel();
    },
    saveUser() {
      axios
        .post("users", this.user)
        .then(response => {
          this.$toasted.show("Success !");
          this.$router.push("/users");
          this.fetchData();
          this.resetpatient();
        })
        .catch(error => {
          this.errors = error.response.data;
          console.log(error.response.data);
        });
    },
    saveEditedUser() {
      axios
        .put(`patients/${this.patient.id}`, this.patient)
        .then(response => {
          this.$toasted.show("Success !");
          this.$router.push("/patients");
          console.log(response.data);
        })
        .catch(error => {
          this.errors = error.response.data;
          console.log(error.response.data);
        });
    },
    fetchData() {
      axios
        .get("users/")
        .then(res => {
          this.users = res.data;
          console.log('####');
          console.log(this.users);
          console.log('####');
        })
        .catch(err => {
          console.log(err);
        });
    }
  },
  mounted() {
    this.fetchData();
  }
};
</script>

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
  text-align: center;
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
</style>