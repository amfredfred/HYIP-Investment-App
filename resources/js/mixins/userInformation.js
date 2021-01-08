import { mapGetters, mapMutations } from "vuex";

export default {
    data() {
        return {
            loading: true,
            details: null
        };
    },
    methods: {
        mountDashboard() {
            this.getUserInformation();
            this.getPlans();
        },

        getUserInformation() {
            const REQUEST_URL = "/user_dashboard/";
            axios
                .get(REQUEST_URL)
                .then(response => {
                    this.updateUserInformation(response.data);
                    this.loading = false;
                })
                .catch(error => {
                    console.log(error);
                });
        },

        getPlans() {
            const REQUEST_URL = "/deposit/";
            axios
                .get(REQUEST_URL)
                .then(response => {
                    this.updateFullDashboardInformation(response.data);
                })
                .catch(error => {
                    console.log("error");
                });
        },

        ...mapMutations("user", [
            "updateUserInformation",
            "updateFullDashboardInformation"
        ])
    },

    computed: {
        ...mapGetters("user", ["userInformation"])
    },

    mounted() {
        this.mountDashboard();
    }
};
