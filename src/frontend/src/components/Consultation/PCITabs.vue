<template>
  <div class="row">
    <div class="col-12">
      <b-card no-body>
        <b-tabs v-model="cindex" pills card vertical>
          <b-tab
            @click="addTab(i)"
            v-for="(tab, i) in ctabs"
            :key="tab"
            :title="tab"
            :active="tab == selected[selected.length - 1]"
          ></b-tab>
          <div class="container-fluid">
            <Problem :index="index" :id="consult.problems[index].id" v-show="check('Problem')" />
            <Medication
              :index="index"
              :id="consult.problems[index].id"
              v-show="check('Medication')"
              :edit="edit"
            />
            <Examination
              :problem_id="consult.problems[index].id"
              :index="index"
              v-show="check('Examination')"
            />
            <Comment :edit="edit" :index="index" :consult="consult" v-show="check('Comment')" />
            <Request
              :edit="edit"
              :index="index"
              :problem_id="consult.problems[index].id"
              v-show="check('Request')"
            />
          </div>
        </b-tabs>
      </b-card>
    </div>
  </div>
</template>
<script>
import { bus } from '../../eventbus'
import { BTabs, BTab, BCard } from 'bootstrap-vue'
import Examination from '../Examination/CExamination'
import Problem from '../Problems/CProblems'
import Medication from '../Medication/CMedication'
import Request from './Request'
import Comment from './Comment'
export default {
  props: ['consult', 'index', 'edit'],
  data() {
    return {
      cindex: 0,
      ctabs: ['Problem', 'Medication', 'Examination', 'Comment', 'Request'],
      selected: ['Problem'],
    }
  },
  methods: {
    check(value) {
      return this.selected.includes(value)
    },
    addTab(index) {
      this.cindex = index
      this.selected.push(this.ctabs[index])
      if (this.ctabs[index] == 'Request') {
        bus.$emit(`show-${this.index}-request-model`)
      }
    },
    isProblemPresent() {},
  },
  components: {
    BTabs,
    BTab,
    BCard,
    Medication,
    Request,
    Problem,
    Examination,
    Comment,
  },
  mounted() {
    bus.$on(`${this.index}-remove-tab`, e => {
      this.selected = this.selected.filter(s => s !== e)
    })
  },
}
</script>