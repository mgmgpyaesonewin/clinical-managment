<template>
  <div class="offset-md-1 col-md-10">
    <div class="card card-content">
      <div class="card-header bg-info">
        <div class="row">
          <h4 class="m-b-0 text-white my-auto">Examination Information</h4>
          <button
            class="btn btn-info"
            @click="() => this.$bvModal.show(`modal-examination-${index}`)"
          >
            <i class="fas fa-plus"></i>
          </button>
          <button class="btn btn-info" @click="removeTab">
            <i class="fas fa-times"></i>
          </button>
          <examination-form
            :id="`modal-examination-${index}`"
            :problem_id="problem_id"
            @reload-examination="getExams"
          />
        </div>
      </div>
      <div class="card-body">
        <div class="col-md-10 offset-md-1">
          <examination-list :examinations="examinations" @reload-examination="getExams"></examination-list>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { bus } from '@/eventbus'
import Form from './Form'
import ExaminationList from './ExaminationList'

export default {
  props: ['index', 'problem_id'],
  components: {
    'examination-form': Form,
    'examination-list': ExaminationList,
  },
  data() {
    return {
      examinations: [],
    }
  },
  methods: {
    removeTab() {
      bus.$emit(`${this.index}-remove-tab`, 'Examination')
      // this.$root.$emit(`${this.index}-remove-tab`, "Problem");
    },
    removeList(i) {
      this.data.splice(i, 1)
    },
    updateData(data) {
      console.log(data)
      this.data.push(data)
    },
    getExams() {
      this.$bvModal.hide(`modal-examination-${this.index}`)
      axios
        .post('getExamination', {
          id: this.problem_id,
        })
        .then(res => {
          this.examinations = res.data
        })
        .catch(e => console.log(e))
    },
  },
  watch: {
    problem_id: {
      immediate: true,
      deep: true,
      handler(newValue, oldValue) {
        console.log(oldValue)
        console.log(newValue)
        if (newValue != null) {
          console.log('data change')
          this.getExams()
        }
      },
    },
  },
}
</script>
<style scoped>
ul {
  padding-inline-start: 20px;
}
</style>
