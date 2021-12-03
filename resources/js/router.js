import Vue from "vue"
import VueRouter from "vue-router"

Vue.use(VueRouter)

import Login from './components/Auth/Login/App'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            name: 'login',
            path: '/login',
            component: Login
        }
    ]
})

export default router