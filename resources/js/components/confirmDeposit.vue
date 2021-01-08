<template>
  <div class="confirm-deposit">
    <div class="hash-form">
      <div v-if="message.length > 0 " class="mb-4">
        <v-alert v-if="errorMessage" :key="index" :message="errorMessage" :type="message_type"></v-alert>
      </div>
      <form method="post" @submit.prevent="try_confirm_deposit($event.target)">
        <div class="mb-4 form-group">
          <label for="transaction-hash lighter-text">Transaction Hash</label>
          <input type="text" class="form-control" id="transaction-hash" name="hash" />
        </div>
        <div class="mb-4 form-group">
          <button class="px-4 btn btn-primary" :disabled="confirming_deposit">
            Confirm Deposit
            <i
              class="fa fa-circle-o-notch fa-spin text-light"
              v-if="confirming_deposit"
              role="status"
            >
              <span class="sr-only">Loading...</span>
            </i>
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
<script>
import messageMixin from "../mixins/messageMixin";
export default {
  name: "confirm-depos9it",
  data() {
    return {
      confirming_deposit: false,
    };
  },
  props: ["transaction_id"],
  methods: {
    try_confirm_deposit(form) {
      this.confirming_deposit = true;
      const transaction_id = this.transaction_id;
      const formdata = new FormData(form);
      formdata.append("transaction_id", transaction_id);

      const REQUEST_URL = "/confirm_deposit";
      axios({
        url: REQUEST_URL,
        method: "post",
        data: formdata,

        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      })
        .then((response) => {
          if (parseInt(response.data.status) === 401) {
            this.confirming_deposit = false;
            return this.displayErrorMessage(response.data.message);
          }

          return this.$router.push({ name: "Dashboard" });
        })
        .catch((error) => {
          this.message = [];
          this.message_type = "danger";
          this.message.push("Cannot complete your request");
        });
    },
  },
  mixins: [messageMixin],
};
</script>
<style>
</style>
