
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

Vue.component('example-component', require('./components/ExampleComponent.vue'));

Vue.component(
    'passport-clients',
    require('./components/passport/Clients')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens')
);

import Vue from 'vue';
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './components/App'
import MeetingsIndex from './components/Meetings/MeetingsIndex'
import VenuesIndex from './components/Meetings/VenuesIndex'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/meetings',
            name: 'meetings',
            component: MeetingsIndex,
        },
        {
            path: '/venues',
            name: 'venues',
            component: VenuesIndex,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
