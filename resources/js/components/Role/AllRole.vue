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
      </div>
    </div>
  </div>
</template>

<script>
import { BModal, VBModal, BButton } from "bootstrap-vue";
import RoleForm from "./RoleForm";

export default {
  components: {
    'role-form': RoleForm,
    BModal,
    BButton,
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
      columns: ["id", "name", 'created_at'],
      roles: [],
    };
  },
  methods: {
    saveRole() {
      axios
        .post("roles", this.role)
        .then(res => {
          this.$toasted.show("Success !");
          this.fetchRoles();
        });
    },
    fetchRoles() {
      axios
        .get('roles/')
        .then(res => this.roles = res.data)
        .catch(err => console.log(err));
    }
  }
}
</script>