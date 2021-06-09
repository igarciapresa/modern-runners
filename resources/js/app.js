require('./bootstrap');

import Vue from 'vue'
import Vuetify from 'vuetify'
import VueRouter from 'vue-router'
import routes from './routes'
import 'vuetify/dist/vuetify.min.css'
import '@fortawesome/fontawesome-free/css/all.css'
import '@fortawesome/fontawesome-free/js/all.js'
Vue.use(Vuetify, {
    theme: {
        dark: '#002d33',
    }
})
Vue.use(VueRouter)

//Main pages
import App from './components/AppComponent.vue'
import Landing from './components/LandingComponent.vue'

const app = new Vue({
    el: '#app',
    components: { App, Landing },
    router: new VueRouter(routes),
    vuetify: new Vuetify({
        theme: {dark: true}
    })
});