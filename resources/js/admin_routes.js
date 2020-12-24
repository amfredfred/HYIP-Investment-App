import setting from "./pages/user/settings.vue";
import manageDeposit from "./pages/admins/manageDeposit.vue";
import manageWithdraw from "./pages/admins/manageWithdraw.vue";
import manageUser from "./pages/admins/manageUser.vue";
import mailsystem from "./pages/admins/mailsystem.vue";
import webSetting from "./pages/admins/webSetting.vue";
import homepageSetting from "./pages/admins/homepageSetting.vue";
import pageSettings from "./pages/admins/pageSettings.vue";
import manageplans from "./pages/admins/manageplans.vue";
import managecompounds from "./pages/admins/managecompounds.vue";
import paymentmethods from "./pages/admins/paymentmethods.vue";
import manageFaq from "./pages/admins/manageFaq.vue";
import manageBenefit from "./pages/admins/manageBenefit.vue";
import manageGetStarted from "./pages/admins/manageGetStarted.vue";
import manageSocial from "./pages/admins/manageSocial.vue";
import twoFactorSuccess from "./pages/user/2factorEnableSuccess.vue";
import dashboard from "./pages/admins/dashboard.vue";

const admin_routes = [
    {
        path: "/",
        component: dashboard,
        name: "Dashboard",
        prop: { icon: "fa-dashboard" }
    },
    {
        path: "/setting",
        component: setting,
        name: "User setting",
        prop: { icon: "fa-cog" }
    },
    {
        path: "/manage-deposit",
        component: manageDeposit,
        name: "Manage deposit",
        prop: { icon: "fa-btc" }
    },
    {
        path: "/manage-withdraw",
        component: manageWithdraw,
        name: "Manage withdraw",
        prop: { icon: "fa-window-maximize" }
    },
    {
        path: "/manage-user",
        component: manageUser,
        name: "Manage user",
        prop: { icon: "fa-users" }
    },
    {
        path: "/mailsystem",
        component: mailsystem,
        name: "mailsystem",
        prop: { icon: "fa-envelope" }
    },
    {
        path: "/Page settings",
        component: pageSettings,
        name: "pagesettings",
        prop: { icon: "fa-globe" }
    },
    {
        path: "/homepage-settings",
        component: homepageSetting,
        name: "Homepage settings",
        prop: { icon: "fa-home" }
    },
    {
        path: "/manage-plans",
        component: manageplans,
        name: "Manage plans",
        prop: { icon: "fa-bookmark" }
    },
    {
        path: "/manage-compounds",
        component: managecompounds,
        name: "Manage compounds",
        prop: { icon: "fa-calendar-o" }
    },
    {
        path: "/payment-methods",
        component: paymentmethods,
        name: "Payment methods",
        prop: { icon: "fa-credit-card" }
    },
    {
        path: "/web-setting",
        component: webSetting,
        name: "Web setting",
        prop: { icon: "fa-gavel" }
    },
    {
        path: "/manage-faq",
        component: manageFaq,
        name: "Manage faq",
        prop: { icon: "fa-question" }
    },
    // {
    //     path: "/manage-benefit",
    //     component: manageBenefit,
    //     name: "Manage benefit",
    //     prop: {}
    // },
    // {
    //     path: "/manage-get-started",
    //     component: manageGetStarted,
    //     name: "Manage-get-started",
    //     prop: {}
    // },
    {
        path: "/manage-social",
        component: manageSocial,
        name: "Manage social",
        prop: { icon: "fa-instagram" }
    },

    {
        path: "/2factor-success",
        component: twoFactorSuccess,
        name: "2factorsuccess",
        prop: {}
    }
];

export default admin_routes;
