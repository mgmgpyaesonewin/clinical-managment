<template>
  <div>
    <div class="row">
      <div class="col-11">
        <h4 class="font-bold">All Examinations</h4>
      </div>

      <div class="col-12">
        <examination-list :examinations="examinations"></examination-list>
      </div>
    </div>
  </div>
</template>
<script>
import ExaminationList from '../Examination/ExaminationList'

export default {
  components: {
    'examination-list': ExaminationList,
  },
  data() {
    return {
      examinations: []
    };
  },
  mounted() {
    axios.get(`examinationPerPatient/${this.$store.state.patient.id}`).then(response => {
      this.examinations = response.data;
      console.log(this.examinations)
    });
  }
};
</script>