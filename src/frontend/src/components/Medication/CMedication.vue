<template>
  <div class="offset-md-1 col-md-10">
    <div class="card card-content tw-rounded-lg tw-overflow-hidden">
      <div class="tw-flex">
        <div class="tw-w-full tw-h-1 tw-bg-blue-500"></div>
      </div>
      <div class="tw-flex flex-wrap tw-m-3">
        <h4 class="tw-m-2 tw-text-xl tw-font-semibold">Medications</h4>
        <div class="tw-flex tw-justify-end tw-flex-grow">
          <div class="tw-flex">
            <button
              class="btn btn-info tw-mx-3"
              @click="() => ( this.$bvModal.show(`modal-medication-${index}`) )"
            >
              <i class="fas fa-plus"></i>
            </button>
            <button class="btn btn-danger" @click="removeTab">
              <i class="fas fa-times"></i>
            </button>
            <medication-form
              :id="`modal-medication-${index}`"
              :problem_id="id"
              @reload-medication="getMedications"
            ></medication-form>
          </div>
        </div>
      </div>
      <div class="card-body">
        <div class="col-md-10 offset-md-1">
          <medication-list :medications="medications" @reload-medication="getMedications">
            <template v-slot:default="list">
              <div class="col-3">
                <div class="col-12">
                  <button class="btn btn-primary" @click="deleteMedication(list)">Delete</button>
                </div>
              </div>
            </template>
          </medication-list>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import AllMedication from './AllMedication'
import MedicationForm from './MedicationForm'

export default {
  props: ['id', 'index'],
  components: {
    'medication-form': MedicationForm,
    'medication-list': AllMedication,
  },
  data() {
    return {
      medicationtype: ['actue', 'repeat'],
      medications: [],
      medication: {
        drug: '',
        dosage: '',
        qty: null,
        duration: null,
        type: null,
        patient_id: this.$store.state.patient.id,
        doctor_id: this.$store.state.user.data.id,
        consultation_id: this.$store.state.consult,
      },
      ierrors: {},
    }
  },
  methods: {
    bindbyid(id) {
      this.medication = this.medications.find(c => c.id === id)
    },
    removeTab() {
      bus.$emit(`${this.index}-remove-tab`, 'Medication')
      // this.$root.$emit(`${this.index}-remove-tab`, "Medication");
    },
    // async alert() {
    //   let { value } = await Swal.fire({
    //     title: 'Are you sure?',
    //     type: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#3085d6',
    //     cancelButtonColor: '#d33',
    //     confirmButtonText: 'Yes, delete it!',
    //   })
    //   return value
    // },
    // async deleteInvestigation(id, index) {
    //   if (await this.alert()) {
    //     axios
    //       .delete(`${this.url}s/${id}`)
    //       .then(res => {
    //         this.$toasted.show('Deleted Successfully !')
    //         this.medications = this.medications.filter(i => i.id !== id)
    //       })
    //       .catch(err => {
    //         this.$toasted.show('Error Deleting Investigation Information', {
    //           icon: 'fa-times-circle',
    //           type: 'error',
    //         })
    //       })
    //   }
    // },
    getMedications() {
      this.$bvModal.hide(`modal-medication-${this.index}`)
      axios.get(`medicationPerPatient/${this.$store.state.patient.id}`).then(response => {
        this.medications = response.data
      })
    },
    deleteMedication(list) {
      const { id } = list
      axios.delete(`medications/${id}`).then(() => {
        this.getMedications()
      })
    },
  },
  mounted() {
    this.getMedications()
  },
}
</script>