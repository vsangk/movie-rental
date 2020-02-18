import Vue from 'vue';
import VueRouter from 'vue-router';
import { Auth0Plugin } from "./auth";
import App from './components/App';
import Profile from './components/Profile';
import ExternalApi from './components/ExternalApi';
import FilmDetail from "./components/FilmDetail";
import { authGuard } from "./auth/authGuard";
import { domain, clientId } from "../../auth_config";

// Register all Vue components
const files = require.context('./', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

const Home = { template: '<h1>Home</h1>' };
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

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'Home',
            component: Home,
        },
        {
            path: '/profile',
            name: 'profile',
            component: Profile,
            beforeEnter: authGuard
        },
        {
            path: "/external-api",
            name: "external-api",
            component: ExternalApi,
            beforeEnter: authGuard
        },
        {
            path: "/film-detail",
            name: "film-detail",
            component: FilmDetail,
        },
        {
            path: '*',
            name: 'not-found',
            component: NotFoundComponent
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
