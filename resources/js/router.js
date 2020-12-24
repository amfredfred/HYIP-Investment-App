import Vue from "vue";
import Router from "vue-router";

import user_routes from "./user_routes";
import admin_routes from "./admin_routes";

Vue.use(Router);

if (window.user === "admin") {
    routes = admin_routes;
} else {
    routes = user_routes;
}

export default new Router({
    // mode: 'history',
    // base: process.env.BASE_URL,
    routes
});
