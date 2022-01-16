import router from './router.js'
import store from './store/index'

import '../css/app.css'

require('./store/subscriber');

require('./bootstrap');

window.Vue = require('vue');

import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

import Vue from 'vue'
import {BootstrapVue, IconsPlugin} from 'bootstrap-vue'

Vue.use(BootstrapVue)
Vue.use(IconsPlugin)


import App from './App'

//mixins
import user from './isAuthenticatedUser';

Vue.mixin(user);

router.beforeEach((to, from, next) => {
    if (!to.matched.length) {
        next('/not-found');
        location.reload();
    } else {
        next();
    }
})

store.dispatch('attempt', localStorage.getItem('token')).then(() => {
    new Vue({
        el: '#app',
        router,
        store,

        components: {App}
    });
});
