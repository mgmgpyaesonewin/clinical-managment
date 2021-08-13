<template>
  <b-modal :id="id" title="Medication Form" hide-footer>
    <form class="form-material form-horizontal">
      <div class="form-group">
        <label class="col-md-4" for="example-email">Doctor</label>
        <input
          type="text"
          class="col-md-8 form-control"
          :value="$store.state.user.data.name"
          disabled
        />
      </div>
      <div class="form-group">
        <label class="col-md-4">Drugs' List</label>
        <select class="col-md-8 form-control">
          <option v-for="(drug, index) in drugs" :key="index">{{ drug }}</option>
        </select>
      </div>
      <div class="form-group" :class="errors.drug ? 'has-danger' : ''">
        <label class="col-md-4 form-control-label" for="example-email">Drug</label>
        <input
          type="text"
          class="col-md-8 form-control"
          :class="errors.drug ? 'form-control-danger' : ''"
          placeholder="Enter Drug Name"
          v-model="drug"
        />
        <div class="offset-md-4 col-md-8 form-control-feedback">{{ errors[0] }}</div>
      </div>
      <div class="form-group">
        <label class="col-md-4" for="example-email">Dosage</label>
        <input type="text" class="col-md-8 form-control" placeholder="Dosage" v-model="dosage" />
      </div>
      <div class="form-group">
        <label class="col-md-4" for="example-email">Quantity</label>
        <input
          min="1"
          type="number"
          class="col-md-8 form-control"
          placeholder="Quantity"
          v-model.number="qty"
        />
      </div>
      <div class="form-group">
        <label class="col-md-4" for="example-email">Duration</label>
        <input
          min="1"
          type="number"
          class="col-md-8 form-control"
          placeholder="x Per Day"
          v-model.number="duration"
        />
      </div>
      <div class="form-group">
        <label class="col-md-4" for="example-email">Type</label>
        <select class="col-md-8 form-control" v-model="type">
          <option v-for="option in medicationtype" :key="option" :value="option">{{ option }}</option>
        </select>
      </div>
      <div class="col-md-8 offset-md-4">
        <button @click.prevent="formsubmit()" type="submit" class="btn btn-info">Submit</button>
      </div>
    </form>
  </b-modal>
</template>
<script>
import API from '@/api.js'
import { drugs } from './drugs'

export default {
  props: ['id', 'problem_id'],
  data() {
    return {
      medicationtype: ['acute', 'repeat'],
      drugs: [],
      drug: null,
      dosage: null,
      qty: null,
      duration: null,
      type: 'acute',
      doctor_id: this.$store.state.user.data.id,
      consultation_id: this.$store.state.consult,
      code: null,
      errors: {},
    }
  },
  methods: {
    formsubmit() {
      axios
        .post(`${this.baseUrl}${API.newMedication}`, {
          drug: this.drug,
          dosage: this.dosage,
          qty: this.qty,
          duration: this.duration,
          type: this.type,
          doctor_id: this.doctor_id,
          consultation_id: this.consultation_id,
          patient_id: this.$store.state.patient.id,
          problem_id: this.problem_id
        })
        .then(res => {
          this.$toasted.show('Success !')
          this.$emit('reload-medication')
        })
        .catch(err => {
          console.log(err.response.data)
          this.errors = err.response.data
        })
    },
  },
  mounted() {
    this.drugs = drugs
  },
}
</script>

<style scoped>
.has-danger .form-control {
  border-bottom-style: solid;
  border-bottom-width: 2px;
  transition: ease-in-out 0.2s all;
}
.form-control-feedback {
  color: #e46a76;
}
</style>