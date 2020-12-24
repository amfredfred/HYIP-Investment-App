import dashboard from "./pages/user/dashboard.vue";
import invest from "./pages/user/invest.vue";
import withdraw from "./pages/user/withdraw.vue";
import referral from "./pages/user/referral.vue";
import setting from "./pages/user/settings.vue";

import choosePlan from "./pages/user/invest/selectPlan.vue";
import payInvest from "./pages/user/invest/pay.vue";
import successfulInvest from "./pages/user/invest/success.vue";
import fund from "./pages/user/invest/fund.vue";

import requestWithdraw from "./pages/user/withdraw/request.vue";
import confirmWithdraw from "./pages/user/withdraw/confirm.vue";

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
        prop: { icon: "fa-diamond" },
        children: [
            {
                name: "Invest",
                path: "",
                component: choosePlan
            },
            {
                path: "pay/:planId",
                component: payInvest,
                name: "payInvest"
            },
            { path: "fund-account", component: fund, name: "fundAccount" },

            {
                path: "success",
                component: successfulInvest,
                name: "successfulInvest"
            }
        ]
    },
    {
        path: "/withdraw",
        component: withdraw,
        prop: { icon: "fa-cube" },
        children: [
            {
                name: "Withdraw",
                path: "",
                component: requestWithdraw
            },
            {
                name: "confirmWithdraw",
                path: "confirm",
                component: confirmWithdraw
            }
        ]
    },
    {
        path: "/referral",
        component: referral,
        name: "Referral",
        prop: { icon: "fa-users" }
    },
    {
        path: "/setting",
        component: setting,
        name: "Settings",
        prop: { icon: "fa-cog" }
    }
];

export default user_routes;
