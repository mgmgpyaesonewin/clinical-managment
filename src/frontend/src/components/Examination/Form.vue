<template>
  <b-modal :id="id" title="Examination Form" hide-footer>
    <div class="form-group">
      <auto-complete
        :items="items"
        placeholder="Enter examination code"
        @select-event="updateData"
      />
    </div>
    <div class="form-group hide">
      <label class="col-md-4" for="example-email">Term</label>
      <input
        type="text"
        class="col-md-8 form-control"
        v-model="exam.term"
        :class="{ 'is-invalid': errors.term ? true : false }"
        placeholder="Enter Consult Term"
      />
    </div>
    <div class="form-group hide">
      <label class="col-md-4" for="example-email">Value</label>
      <input
        type="text"
        class="col-md-8 form-control"
        v-model="exam.value"
        :class="{ 'is-invalid': errors.value ? true : false }"
        placeholder="Enter Consult value"
      />
    </div>
    <div class="form-group form-group-override hide">
      <div class="row">
        <label class="col-md-4 my-auto pl-3" for="example-email">Code</label>
        <div class="col-md-8 pl-0">
          <div class="col-md-12">
            <read-code-picker
              :class="{ 'is-invalid': errors.code ? true : false }"
              :code.sync="exam.code"
            ></read-code-picker>
            <div class="invalid-feedback">{{ errors.code && errors.code[0] }}</div>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group hide">
      <label class="col-md-4" for="example-email">Range</label>
      <input
        type="text"
        v-model="exam.range"
        :class="{ 'is-invalid': errors.range ? true : false }"
        class="col-md-8 form-control"
        placeholder="Enter Range value"
      />
    </div>
  </b-modal>
</template>

<script>
import API from '@/api'
import ReadCodePicker from '../Codepicker'
import AutoComplete from '../AutoComplete'
import { examination_code } from './examination_code'

export default {
  components: {
    'read-code-picker': ReadCodePicker,
    'auto-complete': AutoComplete,
  },
  props: ['id', 'problem_id'],
  data() {
    return {
      data: null,
      items: [],
      exam: {
        term: '',
        doctor_id: this.$store.state.user.data.id,
        consultation_id: this.$store.state.consult,
        value: null,
        code: null,
        patient_id: this.$store.state.patient.id,
        range: null,
      },
      errors: {},
    }
  },
  methods: {
    updateData(data) {
      this.data = data
      this.saveExamination()
    },
    saveExamination() {
      axios
        .post(API.saveExamination, {
          patient_id: this.$store.state.patient.id,
          consultation_id: this.$store.state.consult,
          values: this.data,
          problem_id: this.problem_id,
        })
        .then(res => {
          this.$emit('reload-examination')
        })
        .catch(e => console.log(e))
    },
  },
  mounted() {
    this.items = examination_code.map(c => `(${c.code}) - ${c.name}`)
  },
}
</script>

<style>
</style>