<template>
  <div class="col-12">
    <div class="row">
      <div class="col-12">
        <h4 class="font-bold">All Medications</h4>
        <hr style="width:100%" />
      </div>
    </div>
    <div class="col-7">
      <medication-list :medications="medications"></medication-list>
    </div>
  </div>
</template>

<script>
import AllMedication from './AllMedication'

export default {
  components: {
    'medication-list': AllMedication,
  },
  data() {
    return {
      medications: [],
    }
  },
  methods: {
    getMedications() {
      axios.get(`medicationPerPatient/${this.$store.state.patient.id}`).then(response => {
        this.medications = response.data
      })
    },
  },
  mounted() {
    this.getMedications()
  },
}
</script>

<style>
</style>