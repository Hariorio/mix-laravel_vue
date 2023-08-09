/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import vuetify from './vuetify';

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('header-component', require('./components/Header.vue').default);
// Vue.component('navbar-component', require('./components/navbar.vue').default);
Vue.component('sidebar-component', require('./components/sidebar.vue').default);
Vue.component('dashboard-component', require('./components/dashboard.vue').default);
Vue.component('dt-component', require('./components/dt.vue').default);

//Vue.component('home', home);
//Vue.component('Memek', Memek);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    vuetify
});
