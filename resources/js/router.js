import Vue from "vue"
import VueRouter from "vue-router"
import axios from 'axios'

Vue.use(VueRouter)

import Login from './components/Auth/Login'
import Dashboard from './components/Dashboard/Dashboard'
import Test from './components/Dashboard/Test'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            name: 'login',
            path: '/login',
            component: Login
        },
        {
            name: 'login-pegawai',
            path: '/pegawai/login',
            component: Login
        },
        {
            name: 'dashboard',
            path: '/dashboard',
            component: Dashboard
        },
        {
            name: 'test',
            path: '/test',
            component: Test
        }
    ]
})

// router.beforeEach(async (to, from, next) => {
//     let token = localStorage.getItem('token') == null
//     try {
//         let checkLogin = await check()

//         if (to.matched.some(record => record.meta.requireAuth)) {
//             if (token || checkLogin) {
//                 next({
//                     name: 'login',
//                     query: { redirect: to.fullPath }
//                 })
//             } else if ((!token && to.matched.some(record => )))
//         }
//     } catch (e) {
//         throw new Error('Error:', e)
//     }
// })

function check() {
    return new Promise(resolve => {
        axios.get('/api/user')
            .then(res => {
                resolve(true)
            }).catch(e => resolve(false))
    })
}

export default router
