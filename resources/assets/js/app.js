
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue'

import Vuetify from 'vuetify'
import iview from 'iview'
import {router} from './router/app/index'
import store from './store/app'
import Home from './Home.vue'
import HttpPlugin from './libs/app_http'
import hljs from 'highlight.js'
import Share from 'vue-social-share'

Vue.directive('highlight',function (el) {
    let blocks = el.querySelectorAll('pre code');
    blocks.forEach((block)=>{
        hljs.highlightBlock(block)
    })
})

Vue.use(Vuetify)
Vue.use(iview)
Vue.use(HttpPlugin);
Vue.use(Share)

Vue.component('comment_post', require('./components/comments/Comment_Post.vue'));
Vue.component('comment_root', require('./components/comments/Comment_root.vue'));
Vue.component('comment_child', require('./components/comments/Comment_child.vue'));

const app = new Vue({
    el: '#app',
    store: store,
    router: router,
    render: h => h(Home),
});
