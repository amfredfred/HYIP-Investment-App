import moment from "moment";

export default {
    methods: {
        format_date(date) {
            return moment(date).format("MMMM Do YYYY, h:mm A");
        },

        format_currency(amount) {
            var formatter = new Intl.NumberFormat("en-US", {
                style: "currency",
                currency: "USD"
            });

            return formatter.format(parseFloat(amount));
        },

    }
}