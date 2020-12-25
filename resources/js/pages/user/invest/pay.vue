<template>
  <div>
    <h2 class="text-gray-600">Pay</h2>
    <v-container class="mt-10">
      <v-row>
        <v-col cols="12" sm="6" md="3">
          <v-card>
            <v-card-title class="text-lg font-bold text-green-500">{{plan.name}}</v-card-title>
            <div class="card-body">
              <div class="plan-features">
                <div class="flex justify-between pb-3 mb-12 border-pink-500 feature">
                  <span class="text-base text-gray-600">Min</span>
                  <span class="text-lg font-bold text-gray-700">${{plan.min}}</span>
                </div>

                <div class="flex justify-between pb-3 mb-12 border-pink-500 feature">
                  <span class="text-base text-gray-600">Max</span>
                  <span class="text-lg font-bold text-gray-700">${{plan.max}}</span>
                </div>

                <div class="flex justify-between pb-3 mb-12 border-pink-500 feature">
                  <span class="text-base text-gray-600">Interest</span>
                  <span class="text-lg font-bold text-gray-700">{{plan.percentage}}%</span>
                </div>
              </div>
            </div>

            <div class="p-10 mx-0 deep-purple darken-2 deep-purple--text text--lighten-5">
              <h5 class="font-bold">Current Balance</h5>
              <span class="block text-3xl font-bold">${{balance}}</span>
            </div>
          </v-card>
        </v-col>
        <v-col cols="12" sm="6" md="9">
          <v-alert dismissible v-model="alert">
            {{errorMessage}}
            <template slot="close">
              <v-icon @click="alert = false">fa fa-close</v-icon>
            </template>
          </v-alert>
          <v-form @submit.prevent="initiate_deposit()">
            <v-text-field v-model="form.amount" outlined type="number" label="Amount"></v-text-field>
            <v-select
              :items="coins"
              item-text="name"
              item-value="id"
              label="Payment Method"
              v-model="form.coin_id"
              single-line
              outlined
            ></v-select>

            <v-btn type="submit" :loading="depositing" class="bg-blue-600 text-blue-50">Make Deposit</v-btn>
          </v-form>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
import { mapState, mapMutations } from "vuex";

import messageMixin from "../../../mixins/messageMixin";

export default {
  name: "pay",
  data() {
    return {
      form: {
        coin_id: "",
        amount: "",
      },

      alert: false,

      depositing: false,
    };
  },

  methods: {
    initiate_deposit() {
      this.depositing = true;
      const REQUEST_URL = "/deposit";
      let formdata = new FormData();
      formdata.append("coin_id", this.form.coin_id);
      formdata.append("amount", this.form.amount);
      formdata.append("plan_id", this.plan.id);

      axios({
        url: REQUEST_URL,
        method: "POST",
        data: formdata,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      })
        .then((response) => {
          let returnedStatus = response.data.status;

          if (returnedStatus === 401) {
            this.displayErrorMessage(response.data.message);
            this.depositing = false;
            this.alert = true;
            return;
          }

          if (returnedStatus === "error") {
            this.errorMessage = response.data.message;
            this.depositing = false;
            this.alert = true;
            return;
          }

          this.handle_deposit(response.data);
        })
        .catch((error) => {
          this.errorMessage = "Investment failed, please try again";
          this.depositing = false;
          this.alert = true;
        });
    },

    handle_deposit(deposit_information) {
      this.payment_processed = true;
      if (deposit_information.type === "fund") {
        this.updateFundDetails(deposit_information);
        this.funding_error = true;
        this.making_payment = false;
        return this.$router.push({ name: "fundAccount" });
      }
      return this.$router.push({ name: "successfulInvest" });
    },
    ...mapMutations("user", ["updateFundDetails"]),
  },

  computed: {
    ...mapState("user", {
      plan(state) {
        return state.plans[this.$route.params.planId];
      },

      coins: "userCoin",
      balance: (state) => state.userInformation.total_balance,
    }),
  },

  mounted() {
    if (!this.plan) {
      return this.$router.push({ name: "Invest" });
    }
  },

  mixins: [messageMixin],
};
</script>
<style lang="scss" scoped>
.plan-features {
  .feature {
    border-bottom: 2px solid;
  }
}
</style>
