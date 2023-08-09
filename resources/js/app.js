
require('./bootstrap');

window.Vue = require('vue').default;

import vuetify from './vuetify';

Vue.component('sidebar-component', require('./components/sidebar.vue').default);
Vue.component('dashboard-component', require('./components/dashboard.vue').default);
Vue.component('dt-component', require('./components/dt.vue').default);

const app = new Vue({
    el: '#app',
    vuetify
});
