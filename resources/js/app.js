import router from "./router";

window._ = require("lodash");
window.axios = require("axios");

window.Vue = require("vue");

const app = new Vue({
    router,
    el: "#app"
});

export default app;
