<template>
  <div>
    <div class="offset-md-1 col-md-10">
      <div class="card card-content">
        <div class="card-header bg-info">
          <h4 class="m-b-0 text-white">
            <button class="btn btn-info" @click="removeTab">X</button>
            Request
          </h4>
        </div>
        <div class="card-body">
          <div class="col-md-10 offset-md-1">
            Selected Request
            <hr />
            <dl class="row" v-for="(data, index) in requested" :key="index">
              <dt class="col-sm-4">{{ data.parent }}</dt>
              <dd class="col-sm-4">{{ data.category }}</dd>
              <dd class="col-sm-4">{{ requests[data.parent][data.category][data.request] }}</dd>
            </dl>
          </div>
        </div>
      </div>
    </div>
    <b-modal ref="request" id="modal-1" size="xl" hide-footer>
      <div class="row mt-0">
        <div class="col-3" style="font-size:12px">
          <ul class="list-group mt-0">
            <li
              @click="selectParent(index)"
              v-for="(parent, index) in requests"
              :key="index"
              :class="{ active: selectedParent == index ? true : false }"
              class="list-group-item"
            >
              {{ index }}
              {{ index }}
            </li>
          </ul>
        </div>
        <div class="col-9">
          <div class="mt-2 mb-5" v-for="(data, subcat) in subCatandData" :key="subcat">
            <h5 class="text-success">{{ subcat }}</h5>
            <hr class="w-50 ml-1" />
            <div class="row" style="font-size:12px">
              <div
                v-for="(request, room) in data"
                :key="request"
                class="form-check form-check-inline"
              >
                <input
                  v-model="requested"
                  class="form-check-input"
                  type="checkbox"
                  :id="request"
                  :value="{ parent: selectedParent, category: subcat, request: room }"
                />
                <label class="form-check-label" :for="request">{{ request }}</label>
              </div>
              <div class></div>
            </div>
            <hr class="row" />
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center">
        <button class="btn btn-primary" @click="saveRequest">Save</button>
      </div>
    </b-modal>
  </div>
</template>
<script>
import API from '@/api'
import { bus } from '@/eventbus'
import { VBModal, BModal } from 'bootstrap-vue'
import request from '../../testrequst'
export default {
  data() {
    return {
      requests: [],
      selectedParent: 'Biochemistry',
      subCatandData: {},
      requested: [],
    }
  },
  props: ['problem_id', 'index'],
  components: {
    BModal,
  },
  directives: {
    'b-modal': VBModal,
  },
  watch: {
    requested(value) {
      var len = value.length - 1
      var room = value[len]
    },
  },
  methods: {
    selectParent(index) {
      this.selectedParent = index
      this.subCatandData = this.requests[index]
    },
    removeTab() {
      bus.$emit(`${this.index}-remove-tab`, 'Request')
    },
    showModel() {
      this.$refs['request'].show()
    },
    saveRequest() {
      let data = {
        patient_id: this.$store.state.patient.id,
        consultation_id: this.$store.state.consult,
        dataobject: this.requested,
        problem_id: this.problem_id,
      }
      axios
        .post(API.saveRequest, data)
        .then(res => {
          console.log(res.response)
        })
        .catch(e => {
          console.log(e)
        })
    },
  },
  mounted() {
    this.requests = request
    this.subCatandData = request['Biochemistry']
    bus.$on(`show-${this.index}-request-model`, this.showModel)
  },
}
</script>