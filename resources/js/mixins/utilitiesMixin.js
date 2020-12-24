import moment from "moment";

export default {
    methods: {},
    filters: {
        formatDate(date) {
            return moment(date).format("MMMM Do YYYY, h:mm A");
        },

        formatCurrency(amount) {
            var formatter = new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "USD"
            });

            return formatter.format(parseFloat(amount));
        }
    }
};
