import Vue from "vue";
import Vuex from "vuex";

import router from "./../router/index"

// import modules
import jenis from './JenisStore'
import ruang from './RuangStore'
import level from './LevelStore'
import petugas from './PetugasStore'
import inventaris from './InventarisStore'
import pegawai from './PegawaiStore'
import peminjam from './PeminjamanStore'
import detailpinjam from './DetailPinjamStore'

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        brand: "INVENSTA",
        token: '',
        errors: [],
        success: [],
        isError: false,
        isSuccess: false,
        user: localStorage.getItem('user')
    },
    mutations: {
        set_user(state, user) {
            state.user = user
        },
        set_token(state, token) {
            state.token = token
        },
        set_errors(state, e) {
            state.errors.push(e)
            state.isError = true
        },
        set_success(state, msg) {
            state.success.push(msg)
            state.isSuccess = true
        },
        close_errors(state) {
            state.errors = []
            state.isError = false
        },

        close_success(state) {
            state.success = []
            state.isSuccess = false
        },
        set_headers_token(state, token) {
            localStorage.setItem('token', token)
        },
        set_headers_user(state, user) {
            localStorage.setItem('user', user)
        },
        remove_headers_token(state) {
            localStorage.removeItem('token')
        },
        remove_headers_user(state) {
            localStorage.removeItem('user')
        },
        remove_user_token(state) {
            state.user = null
            state.token = null
        }
    },
    getters: {
        get_user(state) {
            return state.user
        },
        get_token(state) {
            return state.token
        }
    },
    actions: {
     login({ commit }, { value, type }) {
        return new Promise((resolve, reject) => {
            switch (type) {
                case 'pegawai':
                axios.post('/api/v1/auth/pegawai/login', value)
                .then(response => {
                    var { user, token } = response?.data
                    user = JSON.stringify(user)

                    // commit('set_headers_token', String(token))
                    // commit('set_headers_user'. user)

                    commit('set_success', 'berhasil login, mengalihkan...')

                    localStorage.setItem('token', token)
                    localStorage.setItem('user', user)

                    setTimeout(() => {
                        router.replace({ path: 'home/pegawai', query: { success: 'true'} })
                    }, 2000)
                    resolve(response)
                }).catch(e => {

                    // commit('remove_user_token')
                    // commit('remove_headers_user')

                    localStorage.removeItem('token')
                    localStorage.removeItem('user')

                    commit('set_errors', 'username atau password salah.')
                    reject(e)
                })
                break
                default:
                axios.post('/api/v1/auth/login',value)
                .then(response => {
                    var { user, token } = response?.data
                    user = JSON.stringify(user)

                    // commit('set_headers_token', token)
                    // commit('set_headers_user'. user)

                    commit('set_success', 'berhasil login, mengalihkan...')

                    localStorage.setItem('token', token)
                    localStorage.setItem('user', user)

                    setTimeout(() => {
                        router.replace({ path: 'home/admin', query: { success: 'true'} })
                    }, 2000)
                    resolve(response)
                }).catch(e => {

                    // commit('remove_user_token')
                    // commit('remove_headers_user')

                    localStorage.removeItem('token')
                    localStorage.removeItem('user')

                    commit('set_errors', 'username atau password salah.')
                    reject(e)
                })
                break
            }
        })
    },
    close({ commit }) {
        commit('close_errors')
    },
},
modules: {
    jenis,
    ruang,
    level,
    petugas,
    inventaris,
    pegawai,
    peminjam,
    detailpinjam
},
});
