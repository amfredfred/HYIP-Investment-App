
<template>
  <div class="withdraw">
    <section class="request-withdraw">
      <div class="mx-auto md:w-6/12 sm:w-8/12">
        <h4 class="mb-4">Withdraw funds</h4>
        <v-alert dismissible v-model="alert" :color="messageType">
          {{ message }}
          <template slot="close">
            <v-icon @click="alert = false">fa fa-close</v-icon>
          </template>
        </v-alert>
        <section class="card-withdraws">
          <div class="alert alert-danger" v-if="errorMessage.length" role="alert">
            {{errorMessage}}
            <button
              type="button"
              class="close"
              aria-label="Close"
              @click="errorMessage = ''"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div
            v-if="withdrawData.length <= 0"
            class="p-3 mb-3 text-center bg-white rounded text-black-50 shadow-sm"
          >
            <span>Nothing to withdraw yet ...</span>
          </div>
          <div v-for="(account, index) in withdrawData" :key="account.id">
            <div class="p-3 mb-3 bg-white rounded shadow-sm">
              <h6 class="text-sm text-black-50">{{ account.type }}</h6>

              <div class="mt-4">
                <div class="px-3 row">
                  <!-- <div class="mr-5 icon">
                    <i class="fa text-info" :class="withdrawIcons[index].icon"></i>
                  </div>-->
                  <div class="details">
                    <h5 class="mb-2">${{ account.amount }}</h5>
                    <div class="mb-4 date">
                      <span class="text-secondary">
                        {{
                        account.created_at | formatDate
                        }}
                      </span>
                    </div>
                    <button
                      @click.prevent="initiate_withdrawal(account.id, index)"
                      class="px-4 mr-2 btn btn-success"
                      :disabled="requesting"
                    >Withdraw</button>
                    <button
                      @click.prevent="initiate_invest(account.id, index)"
                      class="px-4 btn btn-primary"
                      :disabled="requesting"
                    >Re-invest</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <v-dialog v-model="dialogShown" width="500">
          <v-card>
            <v-card-title class="text-gray-600 headline grey lighten-2">Request Made</v-card-title>

            <v-card-text class="mt-3">Your withdraw request has been made and is being processed</v-card-text>

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
        <template #item.created_at="{ item }">
          {{
          item.created_at | formatDate
          }}
        </template>
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

      withdrawalMethod: [],

      withdrawIcons: [
        { icon: "fa-industry" },
        { icon: "fa-life-ring" },
        { icon: "fa-magnet" },
      ],

      withdrawData: [],

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

      errorMessage: "",
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
          this.withdrawData = response.data.user_withdrawal;
        })
        .catch((error) => {
          console.log(error);
        });
    },

    initiate_withdrawal(id, index) {
      this.requesting = true;
      const formdata = new FormData();

      formdata.append("id", id);

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
          this.handleWithdrawResponse(response.data, index);
        })
        .catch((e) => console.log(e));
    },

    initiate_invest(id, index) {
      this.requesting = true;
      const formdata = new FormData();

      formdata.append("id", id);

      const REQUEST_URL = "reinvest";
      axios({
        url: REQUEST_URL,
        method: "POST",
        data: formdata,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      })
        .then((response) => {
          this.handleInvestResponse(response.data, index);
        })
        .catch((e) => {
          console.log(e);
          this.errorMessage = "Could not perform this action";
          this.requesting = false;
        });
    },

    handleWithdrawResponse(response_data, index) {
      if (response_data.status === "error") {
        this.message = response_data.message;
        this.alert = true;
        this.requesting = false;
        return;
      }

      this.removeWithdrawData(index);
      this.dialogShown = true;
    },

    handleInvestResponse(response_data, index) {
      if (response_data.status === "error") {
        this.message = response_data.message;
        this.alert = true;
        this.requesting = false;
        return;
      }

      this.removeWithdrawData(index);
      this.$router.push({ name: "successfulInvest" });
    },

    removeWithdrawData(index) {
      this.withdrawData.splice(index, 1);
    },

    ...mapMutations("user", ["updateWithdrawData"]),
  },

  mounted() {
    this.getBalanceDetails();
  },
};
</script>
<style lang="scss" scoped>
.card-withdraws {
  height: 15rem;
  max-height: 15rem;
  overflow: auto;

  .date {
    span {
      font-size: 0.8rem;
    }
  }
}
</style>
