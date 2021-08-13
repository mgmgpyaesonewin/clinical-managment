import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        user: JSON.parse(localStorage.getItem('user')) || {},
        patient: JSON.parse(localStorage.getItem('patient')) ||{},
        consult:null,
        loading:false,
    },
    getters:{
      isConsult: state=>state.consult !== null,
      isLoggedIn: state => state.user.access_token !== null,
      isTokenValid: (state,getters) => {
        if(getters.isLoggedIn){
          return state.user.expires_in > Date.now() / 1000;
        }
        return false;
      },
    },
    mutations: {
      setUser: (state, value) => {
        state.user = value;
      },
      setPatient(state,value){
        state.patient=value
      },
      setConsult(state,value){
        state.consult=value
      },
      setLoading(state,value){
        state.loading=value;
      }
    },
    actions:{
      saveUser: ({ commit }, data) => {
        commit('setUser', data);
        localStorage.setItem('user', JSON.stringify(data));
      },
      logoutUser: ({ commit }) => {
        commit('setUser', {});
        localStorage.removeItem('user');
      },
      savePatient({commit},data){
          commit('setPatient',data);
          localStorage.setItem('patient',JSON.stringify(data))
      }
    }
  })
export default store