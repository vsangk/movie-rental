import Vue from 'vue';
import VueRouter from 'vue-router';
import { Auth0Plugin } from "./auth";
import Profile from './components/Profile'
import ExternalApi from './components/ExternalApi'
import { domain, clientId } from "../../auth_config";

// Register all Vue components
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

const NotFoundComponent = { template: '<h1>404 - Not Found</h1>' };

// Register plugins
Vue.use(VueRouter);
Vue.use(Auth0Plugin, {
    domain,
    clientId,
    audience: 'https://api.movie-rental.com',
    onRedirectCallback: appState => {
        router.push(
            appState && appState.targetUrl
                ? appState.targetUrl
                : window.location.pathname
        );
    }
});
Vue.config.productionTip = false;

import App from './components/App';
import {authGuard} from "./auth/authGuard";

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            beforeEnter: authGuard
        },
        {
            path: '*',
            name: 'not-found',
            component: NotFoundComponent
        },
        {
            path: "/external-api",
            name: "external-api",
            component: ExternalApi,
            beforeEnter: authGuard
        }
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
