import Vue from 'vue';
import VueRouter from 'vue-router';

// Register all Vue components
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.use(VueRouter);

import App from './components/App';

const router = new VueRouter({
    mode: 'history',
    routes: [
        // {
        //     path: '/',
        //     name: 'home',
        //     component: Welcome
        // },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
