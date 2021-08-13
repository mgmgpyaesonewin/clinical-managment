<template>
  <div class="tw-bg-gray-100">
    <div class="row">
      <div class="button-group col-12">
        <span class="float-right">
          <button
            class="btn btn waves-effect waves-light btn-primary"
            @click="allConsultations()"
          >All Consultations</button>
          <button
            class="btn btn waves-effect waves-light btn-primary"
            @click="myConsultations()"
          >My Consultations</button>
          <a
            @click.prevent="alert()"
            class="btn btn waves-effect waves-light btn-primary"
            href
            v-if="$can('create consultations')"
          >New</a>
        </span>
        <consultform
          ref="consult"
          :consult.sync="consult"
          :consultations.sync="consultations"
          @submitform="formsubmit()"
        />
      </div>
    </div>
    <div class="col-md-12">
      <div
        class="row"
        @click="changetab(consultation.id)"
        v-for="consultation in consultations"
        :key="consultation.id"
      >
        <div class="col-md-12 tw-bg-gray-100">
          <div class="tw-flex tw-mx-6">
            <div class="tw-flex tw-p-3 tw-w-full">
              <h1 class="tw-text-xl tw-font-medium tw-w-1/4">Consultation</h1>
              <div class="tw-flex tw-flex-col tw-w-3/3">
                <p
                  class="hover:tw-text-orange-500 hover:tw-font-semibold hover:tw-underline"
                >{{ consultation.title }}</p>
                <div class="tw-flex">
                  <div
                    class="tw-py-1 tw-px-2 tw-shadow-md tw-no-underline tw-rounded-full tw-bg-blue-600 tw-text-white tw-font-sans tw-font-medium tw-text-xs"
                  >{{ formattedDate(consultation.created_at) }}</div>
                  <div
                    class="tw-py-1 tw-px-2 tw-shadow-md tw-no-underline tw-rounded-full tw-bg-teal-600 tw-text-white tw-font-sans tw-font-medium tw-text-xs tw-mx-2"
                  >{{ consultation.doctor.name }}</div>
                </div>
              </div>
            </div>
          </div>
          <div class="tw-bg-white tw-shadow-lg tw-rounded-lg tw-m-6 overflow-hidden">
            <div class="tw-flex">
              <div class="tw-w-full">
                <div v-for="(p, index) in consultation.problems" :key="`problem-${index}`">
                  <div class="tw-flex">
                    <div class="tw-w-2 tw-bg-red-500"></div>
                    <div class="tw-flex tw-p-3 tw-w-full">
                      <h1 class="tw-text-xl tw-font-medium tw-w-1/4">Problem</h1>
                      <div class="tw-flex tw-flex-col tw-flex-grow tw-w-3/4">
                        <p>{{ p.code }}</p>
                        <div class="tw-flex">
                          <div
                            class="tw-py-1 tw-px-2 tw-shadow-md tw-no-underline tw-rounded-full tw-bg-blue-600 tw-text-white tw-font-sans tw-font-medium tw-text-xs"
                          >significant</div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="tw-flex">
                    <div class="tw-w-2 tw-bg-indigo-600"></div>
                    <div class="tw-flex tw-p-3 tw-w-full">
                      <h1 class="tw-text-xl tw-font-medium tw-w-1/4">Examinations</h1>
                      <div class="tw-flex tw-flex-col tw-tw-w-3/4">
                        <p
                          v-for="(e, index) in p.examinations"
                          :key="`examination-${index}`"
                        >{{ e.values }}</p>
                      </div>
                    </div>
                  </div>
                  <div class="tw-flex">
                    <div class="tw-w-2 tw-bg-teal-600"></div>
                    <div class="tw-flex tw-p-3 tw-w-full">
                      <h1 class="tw-text-xl tw-font-medium tw-w-1/4">Medications</h1>
                      <div class="tw-flex tw-flex-col tw-tw-w-3/4">
                        <medication-list :medications="p.medications"></medication-list>
                      </div>
                    </div>
                  </div>
                  <div class="tw-flex">
                    <div class="tw-w-2 tw-bg-purple-600"></div>
                    <div class="tw-flex tw-p-3 tw-w-full">
                      <h1 class="tw-text-xl tw-font-medium tw-w-1/4">Requests</h1>
                      <div class="tw-flex tw-flex-col tw-tw-w-3/4">
                        <div class="row--flex" v-for="(r, index) in p.requests" :key="index">
                          <div class="col-md-12">
                            <dl class="row" v-for="(data, index) in r.dataobject" :key="index">
                              <dt class="col-sm-4">{{ data.parent }}</dt>
                              <dd class="col-sm-4">{{ data.category }}</dd>
                              <dd
                                class="col-sm-4"
                              >{{ requests[data.parent][data.category][data.request] }}</dd>
                            </dl>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tw-flex">
                  <div class="tw-w-2 tw-bg-green-800"></div>
                  <div class="tw-flex tw-p-3 tw-w-full">
                    <h1 class="tw-text-xl tw-font-medium tw-w-1/4">Comment</h1>
                    <div class="tw-flex tw-flex-col tw-tw-w-3/4">
                      <p>{{ consultation.comment }}</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang="css">
.has-primary {
  border-color: #fb9678 !important;
}

.form-control:focus {
  box-shadow: 0 0 0 0.2rem rgba(242, 149, 119, 0.25);
}

.row--flex {
  display: flex;
  -ms-flex-wrap: wrap;
  flex-wrap: wrap;
  flex: 0 0 100%;
  max-width: 100%;
}
</style>
<script>
import request from '@/testrequst'
import consultform from '../Consultation/Form'
import moment from 'moment'
import { bus } from '../../eventbus'
import Medication from '../Medication/AllMedication'

export default {
  components: {
    consultform,
    'medication-list': Medication
  },
  data() {
    return {
      consult: {
        address: null,
        title: null,
        type: null,
        patient_id: this.$store.state.patient.id,
      },
      consultations: [],
      doctor_id: this.$store.state.user.data.id,
      term: this.$route.query.term,
      requests: [],
    }
  },
  methods: {
    formsubmit() {
      axios
        .post('consultations', this.consult)
        .then(res => {
          console.log(res.data.id)
          this.$toasted.show('Success !')
          this.$store.commit('setConsult', res.data.id)
          bus.$emit('select-consultation')
        })
        .catch(err => {
          this.errors = err.response.data
          console.log(err.response.data)
        })
    },
    changePatient(value) {
      this.$store.dispatch('savePatient', value)
      this.allConsultations()
    },
    changetab(id) {
      this.$store.commit('setConsult', id)
      this.$emit('setTab')
    },
    alert() {
      this.$refs.consult.$children[0].show()
    },
    formattedDate(date) {
      return moment(date).format('D MMM YYYY, h:mm')
    },
    myConsultations() {
      axios
        .get(`consultations?id=${this.$store.state.patient.id}&d_id=${this.doctor_id}`)
        .then(res => {
          this.consultations = res.data
        })
        .catch(err => console.log(err))
    },
    allConsultations() {
      console.log(this.$store.state.patient.id)
      axios
        .get(`consultations?id=${this.$store.state.patient.id}`)
        .then(res => {
          this.consultations = res.data
        })
        .catch(err => console.log(err))
    },
    search() {
      axios
        .get(`consultations?id=${this.$store.state.patient.id}&term=${this.term}`)
        .then(res => {
          this.consultations = res.data
        })
        .catch(err => console.log(err))
    },
  },
  mounted() {
    bus.$on('changePatient', this.allConsultations)
    this.allConsultations()
    this.requests = request
  },
}
</script>