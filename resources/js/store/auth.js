import axios from "axios"

import router from '../router'
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
            localStorage.setItem('user', JSON.stringify(data))
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
            removeHeaderToken()
            localStorage.removeItem('token')
            localStorage.removeItem('user')
            router.replace({ name: 'login' })
        }
    },
    getters: {
        user(state) {
            return state.user
        },
        get_user() {
            let dataUser = JSON.parse(localStorage.getItem('user'))
            return dataUser || {}
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
        logout({ commit }) {
            commit('reset_user')
        },
        login({ dispatch, commit, getters }, value, type) {
            return new Promise((resolve, reject) => {
                switch (type) {
                    case 'pegawai':
                        axios.post('/api/v1/auth/pegawai/login', value)
                            .then(response => {
                                var token = response?.data.token
                                var user = response?.data.user

                                // set token
                                localStorage.setItem('token', token)
                                setHeaderToken(token)

                                // get user
                                // dispatch('get_user')

                                console.log(token)
                                console.log(user)
                                window.location = router.resolve({ name: 'dashboard' }).href

//                                router.replace({ name: 'dashboard' })
                                // set user
                                commit('set_user', user)
                                resolve(response)
                            }).catch(e => {
                                commit('reset_user')
                                commit('set_errors', 'username atau password salah.')
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

                                console.log(token)
                                console.log(user)
                                window.location = router.resolve({ name: 'dashboard' }).href

//                                router.replace({ name: 'dashboard' })
                                // dispatch('get_user')
                                commit('set_user', user)
                                resolve(response)
                            }).catch(e => {
                                commit('reset_user')
                                commit('set_errors', 'username atau password salah.')
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
