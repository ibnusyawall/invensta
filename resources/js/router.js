import Vue from "vue"
import VueRouter from "vue-router"
import axios from 'axios'

Vue.use(VueRouter)

// Login routes
import Login from './components/Auth/Login'
import LoginPegawai from './components/Auth/Pegawai/Login'


import Dashboard from './components/Dashboard/Dashboard'
import Test from './components/Dashboard/Test'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            name: 'login',
            path: '/login',
            component: Login,
            meta: { guest: true }
        },
        {
            name: 'login-pegawai',
            path: '/pegawai/login',
            component: LoginPegawai,
            meta: { guest: true }
        },
        {
            name: 'dashboard',
            path: '/dashboard',
            component: Dashboard,
            meta: { requireAuth: true }
        },
        {
            name: 'test',
            path: '/test',
            component: Test,
            meta: { requireAuth: true }
        }
    ]
})

router.beforeEach(async (to, from, next) => {
    let token = localStorage.getItem('token') == null
    try {
        let checkLogin = await check()

        if (!!to.matched.some(record => record.meta.requireAuth)) {
            if (token || !checkLogin) {
                next({
                    name: 'login',
                    query: { redirect: to.fullPath }
                })
            } else {
                next()
            }
        } else {
            next()
        }
    } catch (e) {
        console.log(e)
    }
})

function check() {
    return new Promise(resolve => {
        axios.get('/api/user')
            .then(res => {
                resolve(true)
            }).catch(e => resolve(false))
    })
}

export default router
