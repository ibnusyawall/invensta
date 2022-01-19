import Main from './../pages/Operator/Main.vue'

const Operator = [
    {
        name: 'operator-dashboard',
        path: 'operator',
        component: Main,
        meta: {
            requireAuth: true
        }
    },
]

export default Operator
