import VueRouter from "vue-router";
import routes from "./routes";

// configure router
const router = new VueRouter({
    mode: 'history',
    routes,
    linkExactActiveClass: "active",
    scrollBehavior: (to) => {
        if (to.hash) {
            return {
                selector: to.hash
            }
        } else {
            return {
                x: 0,
                y: 0
            }
        }
    }
})

router.beforeEach(async (to, from, next) => {
    var token = localStorage.getItem('token')
    try {
        var checkLogin = await check()
        var isAuth = to.matched.some(record => record.meta.requireAuth)
        var cek = (!!token || !!checkLogin)
        if (isAuth && !cek) {
            next({
                name: 'login',
                query: {
                    redirect: to.fullPath
                }
            })
        } 
            next()
    } catch (e) {
        console.log(e)
    }
})

function check() {
    return new Promise(resolve => {
        axios.get('/api/user')
            .then(res => {
                var user = JSON.stringify(res.data)
                localStorage.setItem('user', user)
                console.log(res?.data)
                resolve(true)
            }).catch(e => {
                console.log(e)
                resolve(false)
            })
    })
}

export default router;