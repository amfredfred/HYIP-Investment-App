import vuetify from "./plugins/vuetify";
import router from "./router";

import store from "./store";

import navbar from "./components/navbar.vue";

import "animate.css";

window.$ = window.jQuery = require("jquery");
window._ = require("lodash");
window.axios = require("axios");

window.Vue = require("vue");

Vue.component("nav-bar", navbar);

const app = new Vue({
    router,
    vuetify,
    store,
    el: "#app"
});

export default app;
