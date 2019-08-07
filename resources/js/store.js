import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        breadcrum: []
    },
    mutations: {
      setBreadcrum (state,breadcrum) {
        state.breadcrum = breadcrum;
      }
    }
  })
export default store