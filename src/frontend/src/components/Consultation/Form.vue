<template>
  <b-modal hide-footer ref="test" id="consult" title="Consultation Properties">
    <div class="card">
      <div class="card-body">
        <form class="form-material form-horizontal">
          <div class="form-group">
            <label for="doctor">Doctor</label>
            <input type="text" class="form-control" :value="$store.state.user.data.name" disabled />
          </div>
          <div class="form-group">
            <label for="doctor">Time</label>
            <input type="text" class="form-control" :value="timeformat" disabled />
          </div>
          <div class="form-group">
            <label for="title">Title</label>
            <input
              type="text"
              v-model="consult.title"
              :class="{'is-invalid':  errors.title ? true : false}"
              class="form-control"
              placeholder="Enter Consult Title"
            />
            <div class="invalid-feedback">{{errors.title && errors.title[0]}}</div>
          </div>
          <div class="form-group">
            <label class="label--padding--bottom">Consultation Type</label>
            <select v-model="consult.type" class="form-control">
              <option selected>Admin note</option>
              <option value="Hospital In Patient Report">Hospital In Patient Report</option>
              <option value="Hospital Out Patient Report">Hospital Out Patient Report</option>
              <option value="Telephone Consolation">Telephone Consolation</option>
              <option value="Laboratory result">Laboratory result</option>
              <option value="Clinic Note">Clinic Note</option>
              <option value="Other note">Other note</option>
              <option value="Face to Face">Face to Face</option>
              <option value="Discussion with Colledge">Discussion with Colledge</option>
              <option value="Group consulation">Group consulation</option>
              <option value="Case Conference">Case Conference</option>
              <option value="Non-consulation Date">Non-consulation Date</option>
              <option value="Scan document">Scan document</option>
            </select>
          </div>
          <div class="form-group">
            <label for="comment" class="label--padding--bottom">Hospital Location Addres</label>
            <textarea
              :class="{'is-invalid':  errors.address ? true : false}"
              class="form-control"
              placeholder="Enter consult Address"
              id
              v-model="consult.address"
              cols="20"
              rows="5"
            ></textarea>
            <div class="invalid-feedback">{{errors.address && errors.address[0]}}</div>
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
  </b-modal>
</template>
<script>
import { BModal } from "bootstrap-vue";

export default {
  props: ["consult"],
  components: {
    BModal
  },
  data() {
    return {
      timeformat: moment().format("MMMM Do YYYY, h:mm"),
      errors: {}
    };
  },
  methods: {
    formsubmit() {
      this.$refs["test"].hide();
      // this.$refs["request"].hide();
      this.$emit("submitform");
    }
  }
};
</script>
<style>
label.label--padding--bottom {
  margin-bottom: 10px !important;
}
</style>