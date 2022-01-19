require('./bootstrap')
/*
 =========================================================
 * Vue Black Dashboard - v1.1.0
 =========================================================

 * Product Page: https://www.creative-tim.com/product/black-dashboard
 * Copyright 2018 Creative Tim (http://www.creative-tim.com)

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 */
 import Vue from "vue";
 import VueRouter from "vue-router";
 import RouterPrefetch from 'vue-router-prefetch'
 import { extend, ValidationProvider } from "vee-validate"
 import * as rules from "vee-validate/dist/rules";
 import App from "./App";
// TIP: change to import router from "./router/starterRouter"; to start with a clean layout
import router from "./router/index";

import store from "./store";
import BlackDashboard from "./plugins/blackDashboard";
import i18n from "./i18n"
import './registerServiceWorker'


Object.keys(rules).forEach(rule => {
	extend(rule, rules[rule])  
})

Vue.use(BlackDashboard);
Vue.use(VueRouter);
Vue.use(RouterPrefetch);

/* eslint-disable no-new */
new Vue({
	router,
	store,
	i18n,
	components: {
		ValidationProvider
	}, 
	render: h => h(App)
}).$mount("#app");
