require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import WelcomeAdmin from './components/WelcomeAdmin';

import Menuadmin from './components/Menuadmin';


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
    components: {
        Menuadmin
    },
    router
});
