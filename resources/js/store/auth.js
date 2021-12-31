import axios from "axios"
import { reject } from "lodash"
import { setHeaderToken, removeHeaderToken } from "../components/utils/auth"

export default {
    state: {
        user: null,
        isLoggedIn: false
    },
    mutations: {
        set_user(state, data) {
            state.user = data
            state.isLoggedIn = true
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
        isLoggedIn(state) {
            return state.isLoggedIn
        }
    },
    actions: {
        login({ dispatch, commit }, type) {
            return new Promise((resolve, reject) => {
                switch (type) {
                    case 'pegawai':
                        axios.post('/api/v1/auth/pegawai/login')
                            .then(response => {
                                var token = response?.data.token
                                localStorage.setItem('token', token)
                                setHeaderToken(token)

                                dispatch('get_user')
                                resolve(response)
                            }).catch(e => {
                                commit('reset_user')
                                localStorage.removeItem('token')
                                reject(e)
                            })
                        break
                    default:
                        axios.post('/api/v1/auth/login')
                            .then(response => {
                                var token = response?.data.token
                                localStorage.setItem('token', token)
                                setHeaderToken(token)

                                dispatch('get_user')
                                resolve(response)
                            }).catch(e => {
                                commit('reset_user')
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
