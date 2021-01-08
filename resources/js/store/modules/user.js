const state = () => ({
    userInformation: null,

    plans: [],
    userCoin: [],

    withdrawData: {},

    recentDeposits: [],

    fundDetails: {}
});

const getters = {
    userInformation(state) {
        return state.userInformation;
    },

    plans(state) {
        return state.plans;
    },

    userCoin(state) {
        return state.userCoin;
    },

    fundDetails(state) {
        return state.fundDetails;
    }
};

const actions = {};

const mutations = {
    updateUserInformation(state, payload) {
        state.userInformation = payload;
    },

    updateFullDashboardInformation(state, payload) {
        state.plans = payload.plan;
        state.userCoin = payload.coins;
        state.recentDeposits = payload.investment.data;
    },

    updateWithdrawData(state, payload) {
        state.withdrawData = payload;
    },

    updateFundDetails(state, payload) {
        state.fundDetails = payload;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
