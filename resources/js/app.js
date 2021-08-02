import Vue from 'vue'
import VueRouter from 'vue-router'
import routes from './routes'
import Transitions from 'vue2-transitions'

Vue.use(VueRouter)
Vue.use(Transitions)



let app = new Vue({
    el: '#app',

    router: new VueRouter(routes),
});
