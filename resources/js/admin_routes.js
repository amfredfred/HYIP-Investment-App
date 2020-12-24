import deposit from './pages/users/deposit.vue';
import withdraw from './pages/users/withdraw.vue';
import setting from './pages/users/setting.vue';
import manageDeposit from './pages/admins/manageDeposit.vue';
import manageWithdraw from './pages/admins/manageWithdraw.vue';
import manageUser from './pages/admins/manageUser.vue';
import mailsystem from './pages/admins/mailsystem.vue';
import webSetting from './pages/admins/webSetting.vue';
import homepageSetting from './pages/admins/homepageSetting.vue';
import pageSettings from './pages/admins/pageSettings.vue';
import manageplans from './pages/admins/manageplans.vue';
import managecompounds from './pages/admins/managecompounds.vue';
import paymentmethods from './pages/admins/paymentmethods.vue';
import manageFaq from './pages/admins/manageFaq.vue';
import manageBenefit from './pages/admins/manageBenefit.vue';
import manageGetStarted from './pages/admins/manageGetStarted.vue';
import manageSocial from './pages/admins/manageSocial.vue';
import twoFactorSuccess from './pages/users/2factorEnableSuccess.vue';


import dashboardAdmin from './pages/dashboardAdmin.vue';

const admin_routes = [{
        path: '/',
        component: dashboardAdmin,
        name: 'admin-dashboard'
    },
    {
        path: '/deposit',
        component: deposit,
        name: 'user-deposit'
    },
    {
        path: '/withdraw',
        component: withdraw,
        name: 'user-withdraw'
    },
    {

        path: '/setting',
        component: setting,
        name: 'user-setting'
    },
    {
        path: '/manage-deposit',
        component: manageDeposit,
        name: 'manage-deposit'
    },
    {
        path: '/manage-withdraw',
        component: manageWithdraw,
        name: 'manage-withdraw'
    },
    {
        path: '/manage-user',
        component: manageUser,
        name: 'manage-user'
    },
    {
        path: '/mailsystem',
        component: mailsystem,
        name: 'mailsystem'
    },
    {
        path: '/page-settings',
        component: pageSettings,
        name: 'pagesettings'
    },
    {
        path: '/homepage-settings',
        component: homepageSetting,
        name: 'homepagesettings'
    },
    {
        path: '/manage-plans',
        component: manageplans,
        name: 'manageplans'
    },
    {
        path: '/manage-compounds',
        component: managecompounds,
        name: 'managecompounds'
    },
    {
        path: '/payment-methods',
        component: paymentmethods,
        name: 'paymentmethods'
    },
    {
        path: '/web-setting',
        component: webSetting,
        name: 'web-setting'
    },
    {
        path: '/manage-faq',
        component: manageFaq,
        name: 'manage-faq'
    },
    {
        path: '/manage-benefit',
        component: manageBenefit,
        name: 'manage-benefit'
    },
    {
        path: '/manage-get-started',
        component: manageGetStarted,
        name: 'manage-get-started'
    },
    {
        path: '/manage-social',
        component: manageSocial,
        name: 'manage-social'
    },

{ path: '/2factor-success', component: twoFactorSuccess, name: "2factorsuccess" }
];



export default admin_routes;
