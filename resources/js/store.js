import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        user: JSON.parse(localStorage.getItem('user')) || {},
    },
    getters:{
      isLoggedIn: state => state.user.access_token !== null,
      isTokenValid: (state,getters) => {
        console.log(state.user)
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
    },
    actions:{
      saveUser: ({ commit }, data) => {
      
        console.log(data)
        commit('setUser', data);
        localStorage.setItem('user', JSON.stringify(data));
      },
    }
  })
export default store