export default {
    data() {
        return {
            errorMessage: "",
            message: ""
        };
    },
    methods: {
        displayErrorMessage(error_message) {
            Object.keys(error_message).forEach(error => {
                let message = error_message[error];
                this.message_type = "danger";
                this.updating_profile = false;
                message.forEach(mes => {
                    this.errorMessage = mes;
                });
            });
        }
    }
};
