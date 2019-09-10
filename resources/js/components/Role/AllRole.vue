<template>
  <div>
    <div class="row page-titles">
      <div class="col-md-5 align-self-center">
        <h4 class="text-themecolor">Listing All Roles</h4>
      </div>
      <div class="col-md-7 col-7 col-sm-7 align-self-center text-right">
        <div class="d-flex justify-content-end align-items-center">
          <breadcrum />
          <button type="button" v-b-modal.create class="btn btn-info d-lg-block m-l-15">
            <i class="fa fa-plus-circle"></i> Create Role
          </button>
        </div>
      </div>
      <div class="row">
        <role-form 
          :errors.sync="errors"
          :role.sync="role"
          modal="create"
          @formsubmit="saveRole()"
        />
        <role-form
          :errors.sync="errors"
          :role.sync="role"
          modal="edit"
          @formsubmit="saveEditedRole()"
        />
      </div>
    </div>
    <div>
      <v-client-table :data="roles" :columns="columns" :options="options">
        <div slot="action" slot-scope="props">
            <a href="#" @click.prevent="binddata(props.row.id)" v-b-modal.edit class="fa fa-edit"></a>
            <delete-role
              @deleteRow="deleterow($event)"
              :roles.sync="roles"
              :index="props.index"
              :data="props.row"
            ></delete-role>
          </div>
      </v-client-table>
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
</style>
<script>
import { BModal, VBModal, BButton } from "bootstrap-vue";
import RoleForm from "./RoleForm";
import deletecomponent from "./DeleteRole.vue";

export default {
  components: {
    'role-form': RoleForm,
    BModal,
    BButton,
    'delete-role': deletecomponent
  },
  directives: {
    "b-modal": VBModal
  },
  data() {
    return {
      modal: 'create',
      role: {
        name: null,
      },
      errors: {},
      columns: ["id", "name", 'created_at', 'action'],
      roles: [],
      options: {
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
          "created_at"
        ],

        filterable: [
          "id",
          "name",
          "created_at"
        ]
      }
    };
  },
  methods: {
     binddata(id) {
      this.role = this.roles.find(r => r.id === id);
    },
    deleterow(id) {
      this.roles = this.roles.filter(r => r.id !== id);
    },
    saveRole() {
      axios
        .post("roles", this.role)
        .then(res => {
          this.$toasted.show("Success !");
          this.fetchRoles();
        })
        .catch(error => {
          this.errors = error.response.data;
          console.log(error.response.data);
        });
    },
    saveEditedRole() {
      console.log()
      axios
        .put(`roles/${this.role.id}`, this.role)
        .then(response => {
          this.$toasted.show("Success !");
          this.$router.push("/roles");
          console.log(response.data);
        })
        .catch(error => {
          this.errors = error.response.data;
          console.log(error.response.data);
        });
    },
    fetchRoles() {
      axios
        .get('roles/')
        .then(res => this.roles = res.data)
        .catch(err => console.log(err));
    }
  },
  mounted() {
    this.fetchRoles()
  }
}
</script>