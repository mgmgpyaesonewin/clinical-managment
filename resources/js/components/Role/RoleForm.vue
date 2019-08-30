<template>
  <b-modal hide-footer :id="this.modal" title="Role's Information">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>
          <form class="form-material form-horizontal">
            <div class="form-group">
              <label class="col-md-12" for="example-email">Name</label>
              <div class="col-md-12">
                <input
                  type="text"
                  v-model="role.name"
                  :class="{'is-invalid':  errors.name ? true : false}"
                  class="form-control"
                  placeholder="Enter Role Name"
                />
                <div class="invalid-feedback">{{errors.name && errors.name[0]}}</div>
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
</template>
<style lang="css">
.bootstrap-datetimepicker-widget {
  background-color: black !important;
  z-index: 9040 !important;
}
</style>
<script>
import { BModal, VBModal, BButton } from "bootstrap-vue";
import datepicker from "./../DatePicker";
export default {
  components: {
    BModal,
    datePicker: datepicker
  },
  props: ["user", "errors", "modal"],
  data() {
    return {};
  },
  methods: {
    formsubmit() {
      this.$emit("formsubmit");
    }
  },
  mounted() {
    this.$root.$on("bv::modal::show", (bvEvent, modalId) => {
      if (modalId === "create") {
        this.$emit("resetpatient");
      }
    });
  }
};
</script>