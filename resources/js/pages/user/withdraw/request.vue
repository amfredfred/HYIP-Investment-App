
<template>
  <div class="withdraw">
    <section class="request-withdraw">
      <div class="mx-auto md:w-6/12 sm:w-8/12">
        <h4 class="mb-4">Withdraw funds</h4>
        <v-alert dismissible v-model="alert" :color="messageType">
          {{message}}
          <template slot="close">
            <v-icon @click="alert = false">fa fa-close</v-icon>
          </template>
        </v-alert>
        <section class="card-wthdrawls">
          <div v-for="(account, index) in withdrawAccount" :key="index">
            <div class="p-3 mb-3 bg-white rounded shadow-sm">
              <h6 class="text-sm text-black-50">{{account.name}}</h6>

              <div class="mt-4">
                <div class="px-3 row">
                  <div class="mr-5 icon">
                    <i class="fa text-info" :class="account.icon"></i>
                  </div>
                  <div class="details">
                    <h5 class="mb-4">$300</h5>
                    <button class="px-4 mr-2 btn btn-success">Withdraw</button>
                    <button class="px-4 btn btn-primary">Re-invest</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <v-dialog v-model="dialogShown" width="500">
          <v-card>
            <v-card-title class="text-gray-600 headline grey lighten-2">Request Made</v-card-title>

            <v-card-text class="mt-3">
              Your withdraw request has been made and is being
              processed
            </v-card-text>

            <v-divider></v-divider>

            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="green darken-2" dark text @click="dialogShown = false">Okay</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </div>
    </section>

    <section class="mt-12">
      <!-- Recent Withdrawals -->
      <h4 class="mb-3 text-lg to-gray-600">Recent Withdrawals</h4>
      <v-data-table
        :headers="tableHeaders"
        :items="transactions.data"
        :items-per-page="5"
        class="elevation-1"
      >
        <template #item.created_at="{ item }">{{item.created_at | formatDate }}</template>
        <template #item.status="{ item }">
          <v-chip v-if="item.status == 1" color="green" text-color="white">Completed</v-chip>
          <v-chip v-if="item.status == 0" color="yellow" text-color="white">Pending</v-chip>
        </template>
      </v-data-table>
    </section>
  </div>
</template>
<script>
import { mapMutations } from "vuex";

import utilitiesMixin from "../../../mixins/utilitiesMixin";

export default {
  name: "withdraw",
  data() {
    return {
      dialogShown: false,
      form: {
        amount: "",
        withdrawAccount: "",
        withdrawalMethod: "",
      },

      withdrawalMethod: [],

      withdrawAccount: [
        { name: "Main Balance", number: 2, icon: "fa-industry" },
        { name: "Profit Balance", number: 3, icon: "fa-life-ring" },
        { name: "Referral Bonus", number: 4, icon: "fa-magnet" },
      ],

      tableHeaders: [
        {
          text: "Date",
          value: "created_at",
        },
        {
          text: "Transaction Id",
          value: "transaction_id",
        },
        {
          text: "Amount",
          value: "amount",
        },
        {
          text: "Status",
          value: "status",
        },
      ],

      transactions: [],

      alert: false,
      message: "",
      messageType: "",

      requesting: false,

      formValid: false,

      rules: {
        amount: (value) => !!value || "Amount required",
        account: (value) => !!value || "Select Withdraw Account",
        method: (value) => !!value || "Select Withdraw Method",
      },
    };
  },
  mixins: [utilitiesMixin],
  methods: {
    getBalanceDetails() {
      const REQUEST_URL = "/withdraw";
      axios
        .get(REQUEST_URL)
        .then((response) => {
          this.transactions = response.data.withdraws;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    initiate_withdrawal() {
      if (!this.formValid) {
        return false;
      }

      this.requesting = true;
      const formdata = new FormData();
      formdata.append("coin", this.form.withdrawalMethod);
      formdata.append("withdraw_from", this.form.withdrawAccount);
      formdata.append("amount", this.form.amount);

      const REQUEST_URL = "withdraw";
      axios({
        url: REQUEST_URL,
        method: "POST",
        data: formdata,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      })
        .then((response) => {
          this.handle_withdraw_response(response.data);
        })
        .catch((e) => console.log(e));
    },

    handle_withdraw_response(response_data) {
      if (response_data.status === "error") {
        this.message = response_data.message;
        this.alert = true;
        this.requesting = false;
        return;
      }

      this.updateWithdrawData(response_data);
      this.$router.push({ name: "confirmWithdraw" });
    },

    ...mapMutations("user", ["updateWithdrawData"]),
  },

  mounted() {
    this.getBalanceDetails();
  },
};
</script>
