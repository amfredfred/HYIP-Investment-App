const state = () => ({
    userInformation: null
});

const getters = {
    userInformation(state) {
        return state.userInformation;
    }
};

const actions = {};

const mutations = {
    updateUserInformation(state, payload) {
        state.userInformation = payload;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
};
