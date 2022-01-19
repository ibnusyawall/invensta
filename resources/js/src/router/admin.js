import Main from './../pages/Admin/Main.vue'
// import Home from './../components/Dashboard/Admin/Home.vue'

const Admin = [
    {
        name: 'admin-dashboard',
        path: 'admin',
        component: Main,
        meta: {
            requireAuth: true
        }
    },
]

export default Admin
