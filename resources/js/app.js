require('./bootstrap');

window.Vue = require('vue');

import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import WelcomeAdmin from './components/WelcomeAdmin'
import Menuadmin from './components/Menuadmin'
import CreatePost from './components/CreatePost'
import AllPosts from './components/AllPosts'
import EditPost from './components/EditPost'
import AllCategories from './components/AllCategories'
import EditCategory from './components/EditCategory'
import CreateCategory from './components/CreateCategory'
import HomepagePosts from './components/HomepagePosts'
import ReadPost from './components/ReadPost'
import Menuhomepage from './components/Menuhomepage'

const router = new VueRouter({
    routes: [
      {
        path: '/',
        name: 'homepageposts',
        component: HomepagePosts
      },
      {
        path: '/read/:id',
        name: 'readpost',
        component: ReadPost
      },
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
      },
      {
        path: '/admin/editpost/:postId/edit',
        name: 'editpost',
        component: EditPost,
        props: true
      },
      {
        path: '/admin/allcategories',
        name: 'allcategories',
        component: AllCategories,
        props: true
      },
      {
        path: '/admin/editcategory/:categoryId/edit',
        name: 'editcategory',
        component: EditCategory,
        props: true
      },
      {
        path: '/admin/createcategory',
        name: 'createcategory',
        component: CreateCategory,
        props: true
      },
    ],
    mode : 'history' 
})

const app = new Vue({
    el: '#app',
    components: {
        Menuadmin,
        Menuhomepage
    },
    router
});
