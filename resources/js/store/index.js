import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        token: null,
        user: null,
        login_errors: {},
    },
    getters: {
        authenticated(state) {
            return state.token && state.user
        },

        user(state) {
            return state.user
        },

        login_errors(state) {
            return state.login_errors
        },
    },
    mutations: {
        SET_TOKEN(state, token) {
            state.token = token
        },

        SET_USER(state, data) {
            state.user = data
        },

        SET_LOGIN_ERRORS(state, errors) {
            state.login_errors = errors
        },
    },
    actions: {
        async signIn({dispatch, commit}, credentials) {
            let response = await axios.post('api/auth/login', credentials);
            if (response.data && response.data.data && response.data.data.errors.validations) {
                commit('SET_LOGIN_ERRORS', response.data.data.errors.validations)
            } else {
                commit('SET_LOGIN_ERRORS', "")
                return dispatch('attempt', response.data.access_token);
            }
        },
        async attempt({commit, state}, token) {
            if (token) {
                commit('SET_TOKEN', token)
            }
            if (!state.token) {
                return
            }
            try {
                let response = await axios.get('api/auth/user')
                if (Object.keys(response.data).length === 0) {
                    commit('SET_TOKEN', null)
                }
                commit('SET_USER', response.data)
            } catch (e) {
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            }
        },
        signOut({commit}) {
            return axios.get('api/auth/logout').then(() => {
                commit('SET_TOKEN', null)
                commit('SET_USER', null)
            });
        }
    },

});
