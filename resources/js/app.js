import vuetify from "./plugins/vuetify";
import router from "./router";

import navbar from "./components/navbar.vue";

window._ = require("lodash");
window.axios = require("axios");

window.Vue = require("vue");

Vue.component("nav-bar", navbar);

const app = new Vue({
    router,
    vuetify,
    el: "#app"
});

export default app;
