/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import router from './router'
import store from './store';
import App from './components/App.vue'
import { setHeaderToken } from './components/utils/auth';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const token = localStorage.getItem('token')

if (token) {
    setHeaderToken(token)
}
store.dispatch('get_user', token)
    .then(() => {
        new Vue({
            el: '#app',
            components: {
                App
            },
            router,
            store
        });
    })
