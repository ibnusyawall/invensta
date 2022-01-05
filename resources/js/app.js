/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import { ValidationProvider, extend } from 'vee-validate'
import * as rules  from 'vee-validate/dist/rules'

import router from './router'
import store from './store'
import App from './components/App.vue'
import { setHeaderToken } from './utils/auth'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const token = localStorage.getItem('token')

if (token) {
    setHeaderToken(token)
}

Object.keys(rules).forEach(rule => {
    extend(rule, rules[rule])
})

/**
 * @extend custom required validate form
 **/

// extend('required', {
//     ...required,
//     message: 'The {_field_} is required.'
// })

/**
 * @extend custom min length validate form
 **/

// extend('min', {
//     validate(value, { length }) {
//         return value.length >= length
//     },
//     params: ['length'],
//     message: 'The {_field_} field must have at least {length} characters.'
// })

const app = new Vue({
    el: '#app',
    router,
    store,
    components: {
        App,
        ValidationProvider
    },
    data: () => ({
        value: ''
    }),
})
