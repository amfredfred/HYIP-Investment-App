import dashboard from "./pages/user/dashboard.vue";
import invest from "./pages/user/invest.vue";

const user_routes = [
    {
        path: "/",
        component: dashboard,
        name: "Dashboard",
        prop: { icon: "fa-home" }
    },
    {
        path: "/invest",
        component: invest,
        name: "Invest",
        prop: { icon: "fa-diamond" }
    }
];

export default user_routes;
