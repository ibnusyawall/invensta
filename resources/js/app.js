require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import router from './router'

Vue.use(VueRouter)

import App from './components/App.vue'

const app = new Vue({
    el: '#app',
    components: { App },
    router
});
