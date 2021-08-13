<template>
  <div>
    <div class="col-sm-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"></h5>
          <form class="form-material form-horizontal">
            <div class="form-group">
              <div class="row mx-0">
                <label class="col-md-6" for="example-email">Doctor</label>
                <label class="col-md-6" for="example-email">{{$store.state.user.data.name}}</label>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12" for="example-email">Term</label>
              <div class="col-md-12">
                <input
                  type="text"
                  v-model="invest.term"
                  :class="{'is-invalid':  errors.term ? true : false}"
                  class="form-control"
                  placeholder="Enter Consult Term"
                />
                <div class="invalid-feedback">{{errors.term && errors.term[0]}}</div>
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-12" for="example-email">Value</label>
              <div class="col-md-12">
                <input
                  type="text"
                  v-model="invest.value"
                  :class="{'is-invalid':  errors.value ? true : false}"
                  class="form-control"
                  placeholder="Enter Consult value"
                />
                <div class="invalid-feedback">{{errors.value && errors.value[0]}}</div>
              </div>
            </div>
            <div class="form-group form-group-override">
              <label class="col-md-12" for="example-email">Code</label>
              <div class="col-md-12">
                <codepicker :code.sync="invest.code"></codepicker>
                <div class="invalid-feedback">{{errors.code && errors.code[0]}}</div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-12" for="example-email">Range</label>
              <div class="col-md-12">
                <input
                  type="text"
                  v-model="invest.range"
                  :class="{'is-invalid':  errors.range ? true : false}"
                  class="form-control"
                  placeholder="Enter Consult value"
                />
                <div class="invalid-feedback">{{errors.range && errors.range[0]}}</div>
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
  </div>
</template>
<script>
import codepicker from "../Codepicker";
import { BModal } from "bootstrap-vue";

export default {
  props: ["invest", "errors", "id"],
  components: {
    BModal,
    codepicker
  },
  data() {
    return {
      isLoading: false,
      codes: []
    };
  },
  methods: {
    formsubmit() {
      this.invest.code = `(${this.invest.code.code})${this.invest.code.title}`;
      console.log(this.invest);
      this.$emit("submitform");
    }
  },
  mounted() {}
};
</script>
<style lang="css">
.form-group-override {
  overflow: unset !important;
}
</style>