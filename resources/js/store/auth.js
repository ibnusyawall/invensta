import axios from "axios"
import { setHeaderToken, removeHeaderToken } from "../utils/auth"

export default {
    strict: true,
    state: {
        user: null,
        isLoggedIn: false,
        brand: 'INVENSTA',
        errors: [],
        isError: false,
    },
    mutations: {
        set_user(state, data) {
            state.user = data
            state.isLoggedIn = true
        },
        set_example(state, data = {}) {
            state.example = { ...data }
        },
        set_errors(state, e) {
            state.errors.push(e)
            state.isError = true
        },
        close_errors(state) {
            state.errors = []
            state.isError = false
        },
        add_count(state) {
            state.count += 1
        },
        reset_count(state) {
            state.count = 1
        },
        reset_user(state) {
            state.user = null
            state.isLoggedIn = true
        }
    },
    getters: {
        user(state) {
            return state.user
        },
        example(state) {
            return state.example
        },
        isLoggedIn(state) {
            return state.isLoggedIn
        },
        get_state(state) {
            return state
        },
        get_count(state) {
            return state.count
        },
    },
    actions: {
        get_example({ dispatch, commit }, v) {
            dispatch('_getsample', v)
            //commit('set_example', data)
        },
        async _getsample({ commit }, v) {
            let data = v || { a: 1, b: 2 }
            commit('set_example', data)
        },
        close({ commit }) {
            commit('close_errors')
        },
        add_count({ commit }) {
            commit('add_count')
        },
        reset_count({ commit }) {
            commit('reset_count')
        },
        login({ dispatch, commit, getters }, value, type) {
            return new Promise((resolve, reject) => {
                switch (type) {
                    case 'pegawai':
                        axios.post('/api/v1/auth/pegawai/login', value)
                            .then(response => {
                                var token = response?.data.token
                                var user = response?.data.user

                                localStorage.setItem('token', token)
                                setHeaderToken(token)

                                dispatch('get_user')
                                commit('set_user', user)
                                resolve(response)
                            }).catch(e => {
                                commit('reset_user')
                                localStorage.removeItem('token')
                                reject(e)
                            })
                        break
                    default:
                        axios.post('/api/v1/auth/login', value)
                            .then(response => {
                                var token = response?.data?.token
                                var user = response?.data?.user

                                localStorage.setItem('token', token)
                                setHeaderToken(token)

                                dispatch('get_user')
                                commit('set_user', user)
                                resolve(response)
                            }).catch(e => {
                                commit('reset_user')
                                commit('set_errors', 'username atau password salah.')
                                let _e = getters.get_state
                                console.log(_e)
                                localStorage.removeItem('token')
                                reject(e)
                            })
                        break
                }
            })
        },
        async get_user({ commit }) {
            if (!localStorage.getItem('token')) return
            try {
                let response = await axios.get('/api/user')
                commit('set_user', response?.data.user)
            } catch (error) {
                commit('reset_user')
                removeHeaderToken()
                localStorage.removeItem('token')
                return error
            }
        }
    }
}
