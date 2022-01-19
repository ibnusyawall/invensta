import Main from './../pages/Pegawai/Main.vue'

const Pegawai = [
    {
        name: 'pegawai-dashboard',
        path: 'pegawai',
        component: Main,
        meta: {
            requireAuth: true
        }
    },
]

export default Pegawai
