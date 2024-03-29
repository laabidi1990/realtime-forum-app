/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuetify from '../plugins/vuetify';

import router from './router/router';

import Vue from 'vue'
import VueSimplemde from 'vue-simplemde'
import 'simplemde/dist/simplemde.min.css'

import User from './helpers/User';
window.User = User;

import Exception from './helpers/Exception';
window.Exception = Exception;

window.EventBus = new Vue();

Vue.component('app-home', require('./components/AppHome').default);
Vue.component('vue-simplemde', VueSimplemde);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    vuetify: Vuetify,
    el: '#app',
    router
});
