const state = () => ({
    userInformation: null,
    plans: [],
    userCoin: []
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
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
