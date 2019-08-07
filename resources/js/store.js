import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        loggedIn: false,
        accessToken: localStorage.getItem('access_token') || null,
        expiresIn: localStorage.getItem('expires_in') || null,
    },
    getters:{
      isLoggedIn: state => state.accessToken !== null,
      isTokenValid: (state,getters) => {
        if(getters.isLoggedIn){
          return state.expiresIn > Date.now() / 1000;
        }
        return false;
      },
    },
    mutations: {
      setToken: (state, value) => {
        state.accessToken = value;
      },
      setExpiresIn:(state,value)=>{
        state.expiresIn = value;
      }
    },
    actions:{
      saveUser: ({ commit }, data) => {
        commit('setToken', data.access_token);
        commit('setExpiresIn', data.expires_in);
        localStorage.setItem('access_token', data.access_token);
        localStorage.setItem('expires_in', data.expires_in);
      },
    }
  })
export default store