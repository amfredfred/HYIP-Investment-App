import dashboard from "./pages/user/dashboard.vue";
import transactions from "./pages/user/transactions.vue";
import invest from "./pages/user/invest.vue";
import withdraw from "./pages/user/withdraw.vue";
import referral from "./pages/user/referral.vue";
import setting from "./pages/user/settings.vue";

import choosePlan from "./pages/user/invest/selectPlan.vue";
import payInvest from "./pages/user/invest/pay.vue";
import successfulInvest from "./pages/user/invest/success.vue";
import fundAccount from "./pages/user/invest/fund.vue";

import requestWithdraw from "./pages/user/withdraw/request.vue";
import confirmWithdraw from "./pages/user/withdraw/confirm.vue";

const user_routes = [
    {
        path: "/",
        component: dashboard,
        name: "Dashboard",
        prop: { icon: "fa-dashboard" }
    },

    {
        path: "/invest",
        component: invest,
        prop: { icon: "fa-bank" },
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
            {
                path: "fund-account",
                component: fundAccount,
                name: "fundAccount"
            },

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
        prop: { icon: "fa-money" },
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
        path: "/transactions",
        component: transactions,
        name: "Transactions",
        prop: { icon: "fa-cog" }
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
