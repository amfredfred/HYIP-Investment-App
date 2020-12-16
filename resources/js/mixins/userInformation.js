import { mapGetters, mapMutations } from "vuex";

export default {
    data() {
        return {
            loading: true
        };
    },
    methods: {
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
        ...mapMutations("user", ["updateUserInformation"])
    },
    computed: {
        ...mapGetters("user", ["userInformation"])
    },
    mounted() {
        this.getUserInformation();
    }
};
