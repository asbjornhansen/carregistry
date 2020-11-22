import Vue from 'vue';
import App from '../src/components/App.vue';

import VueRouter from 'vue-router'

Vue.use(VueRouter)

const routes = [
    {
        path: '/',
        component: require('./components/Overview').default,
        name: 'Overview'
    },
    {
        path: '/brands',
        component: require('./components/Brands').default,
        name: 'Brands'
    }
];

const router = new VueRouter({
    routes: routes,
    mode: "history"
})

new Vue({
    el: '#vueapp',
    router: router,
    render: h => h(App),
});
