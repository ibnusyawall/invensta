import VueRouter from "vue-router";
import routes from "./routes";

// configure router
const router = new VueRouter({
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
    var token = localStorage.getItem('token') == null
    try {
        var checkLogin = await check()

        if (to.matched.some(record => record.meta.requireAuth)) {
            console.log(checkLogin)
            console.log(token)
            if (token || checkLogin) {
                next({
                    name: 'login',
                    query: {
                        redirect: to.fullPath
                    }
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

export default router;