require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import WelcomeAdmin from './components/WelcomeAdmin';

const router = new VueRouter({
    routes: [
      {
        path: '/admin/dashboard',
        name: 'dashboard',
        component: WelcomeAdmin
      }
    ],
    mode : 'history' 
})

const app = new Vue({
    el: '#app',
    router
});
