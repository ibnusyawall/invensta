import axios from "axios"

export default {
    strict: true,
    state: {
        name: 'jenis',
        data: [],
        action: '',
        message: null,
        isError: false,
        auth: {
            token: localStorage.getItem('token'),
            user: localStorage.getItem('user')
        },
    },
    mutations: {
        set_data(state, data) {
            state.data = data
        },
        set_action(state, msg) {
            state.action = msg
        },
        set_message(state, msg) {
            state.message = msg
        },
        set_error(state, error) {
            state.isError = error
        },
        remove_data(state) {
            state.data = []
        }
    },
    getters: {
        get_data(state) {
            return state.data
        },
        get_action(state) {
            return state.action
        },
        get_message(state) {
            return state.message
        },
        get_error(state) {
            return state.isError
        }
    },
    actions: {
        ruangs({ commit, state }) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios(`/api/v1/${state.name}`)
                    commit('set_data', data)

                    commit('set_message', 'semua data berhasil diambil.')
                    commit('set_error', false)
                    resolve(data)
                } catch (e) {
                    commit('remove_data')

                    commit('set_message', 'data gagal diambil.')
                    commit('set_error', true)
                    reject(e)
                }
            })
        },
        ruang({ commit, state }, { id }) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios(`/api/v1/${state.name}`)
                    commit('set_data', data)
                    
                    commit('set_message', 'data berhasil diambil.')
                    commit('set_error', false)
                    resolve(data)
                } catch (e) {
                    commit('remove_data')

                    commit('set_message', 'data gagal diambil.')
                    commit('set_error', true)
                    reject(e)
                }
            })
        },
        add({ commit, state }, { data }) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios.post(`/api/v1/${state.name}`, { ...data })
                    commit('set_data', data)
                    
                    commit('set_message', 'data berhasil ditambahkan.')
                    commit('set_error', false)
                    resolve(data)
                } catch (e) {
                    commit('remove_data')

                    commit('set_message', 'data gagal ditambahkan.')
                    commit('set_error', true)
                    reject(e)
                }
            })
        },
        update({ commit, state }, { id, data }) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios.put(`/api/v1/${state.name}/${id}`, { ...data })
                    commit('set_data', data)
                    
                    commit('set_message', 'data berhasil di perbaharui.')
                    commit('set_error', false)
                    resolve(data)
                } catch {
                    commit('remove_data')

                    commit('set_message', 'data gagal di perbaharui.')
                    commit('set_error', true)
                    reject(e)
                }
            })
        },
        _delete({ commit, state }, { id }) {
            return new Promise(async (resolve, reject) => {
                try {
                    let { data } = await axios.delete(`/api/v1/${state.name}/${id}`)
                    commit('set_data', data)
                    
                    commit('set_message', 'data berhasil dihapus.')
                    commit('set_error', false)
                    resolve(data)
                } catch (e) {
                    commit('remove_data')

                    commit('set_message', 'data gagal dihapus.')
                    commit('set_error', true)
                    reject(e)
                }
            })
        },
    }
}