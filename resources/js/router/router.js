import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import Login from '../components/login/Login';
import Signup from '../components/login/Signup';
import Logout from '../components/login/Logout';
import Forum from '../components/Forum';

const routes = [
    { path: '/login', component: Login, name:'login' },
    { path: '/signup', component: Signup, name: 'signup' },
    { path: '/logout', component: Logout, name: 'logout' },
    { path: '/forum', component: Forum, name: 'forum' },
    // { path: '/ask-question', component: Signup, name: 'ask-question' },
]

const router = new VueRouter({
    routes, // short for `routes: routes`
    mode: 'history',
})

export default router;