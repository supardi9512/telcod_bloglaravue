require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import WelcomeAdmin from './components/WelcomeAdmin'
import Menuadmin from './components/Menuadmin'
import CreatePost from './components/CreatePost'
import AllPosts from './components/AllPosts'

const router = new VueRouter({
    routes: [
      {
        path: '/admin/dashboard',
        name: 'dashboard',
        component: WelcomeAdmin
      },
      {
        path: '/admin/createpost',
        name: 'createpost',
        component: CreatePost,
        props: true
      },
      {
        path: '/admin/allposts',
        name: 'allposts',
        component: AllPosts,
        props: true
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
