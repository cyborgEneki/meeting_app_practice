/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.use(VueRouter);
Vue.use(VeeValidate);
Vue.use(VueNoty);

Vue.component('passport-clients', Clients);
Vue.component('passport-authorized-clients', AuthorizedClients);
Vue.component('passport-personal-access-tokens', PersonalAccessTokens);

import Vue from 'vue';

import VueRouter from 'vue-router';

import VeeValidate from 'vee-validate';

Vue.component('multiselect', Multiselect);

import VueNoty from 'vuejs-noty';

import App from './components/App'
import Clients from './components/passport/Clients'
import AuthorizedClients from './components/passport/AuthorizedClients'
import PersonalAccessTokens from './components/passport/PersonalAccessTokens'

import store from './store/store'
import router from './routes.js'

const app = new Vue({
    el: '#app',
    store,
    components: {App},
    router,
});
