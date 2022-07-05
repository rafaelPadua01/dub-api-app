/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import Router from './router/index.js' 

//Instancias da classes do Vuetify
Vue.use(Vuetify);




 /* The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('navigation-drawer-component', require('./components/layout/NavigationDrawerComponent.vue').default);
Vue.component('appbar-component', require('./components/layout/AppBarComponent.vue').default);
Vue.component('dashboard-component', require('./components/Dashboard.vue').default);
Vue.component('categories-component', require('./components/views/CategoriesComponent.vue').default);
Vue.component('home-component', require('./components/views/HomeComponent.vue').default);
Vue.component('footer-component', require('./components/layout/FooterComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const app = new Vue({
	vuetify: new Vuetify(),
	router: Router,
  	 el: '#app',
});
