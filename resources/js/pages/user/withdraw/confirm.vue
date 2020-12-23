<template>
  <div class="confirmWithdrawl">
    <h3 class="text-lg text-gray-600">Confirm Withdrawal details</h3>

    <section>
      <v-col cols="12" sm="8" md="4">
        <v-card class="shadow-sm">
          <v-row>
            <v-col cols="7">
              <ul class="mt-5 list-unstyled">
                <li>
                  <div class="mb-5">
                    <h6 class="text-xs font-bold text-gray-700">{{withdrawData.name_full}} Value</h6>
                    <span class="block text-base text-gray-600">${{withdrawData.amount_convert}}</span>
                  </div>
                </li>
                <li>
                  <div class="mb-5">
                    <h6 class="text-xs font-bold text-gray-700">Withdrawal Type</h6>
                    <span class="block text-base text-gray-600">{{withdrawData.name_full}}</span>
                  </div>
                </li>
                <li>
                  <div class="mb-5">
                    <h6 class="text-xs font-bold text-gray-700">Wallet Address</h6>
                    <span class="block text-base text-gray-600">{{withdrawData.address}}</span>
                  </div>
                </li>
              </ul>
            </v-col>
            <v-col cols="5">
              <div class="p-3 mr-2 bg-green-700 rounded-md">
                <h6 class="mb-3 font-bold text-green-100">You want to withdraw</h6>
                <h3 class="font-bold text-yellow-400">${{withdrawData.withdraw.amount}}</h3>
              </div>
            </v-col>
          </v-row>
        </v-card>
        <div class="flex justify-between mt-5">
          <div class="inline-block">
            <v-btn text color="grey darken-3" :to="{name: 'Withdraw'}">Back</v-btn>
          </div>
          <div class="inline-block">
            <v-btn class="text-green-100 bg-green-800" @click="withdrawal_confirmation()">Confirm</v-btn>
          </div>
        </div>
      </v-col>
    </section>
  </div>
</template>
<script>
import { mapState } from "vuex";

export default {
  name: "confirmWithdraw",

  data() {
    return {
      confirming: false,
      message: "",
      alert: false,
    };
  },
  methods: {
    withdrawal_confirmation() {
      this.confirming = true;
      const formdata = new FormData();
      formdata.append("withdraw", this.withdrawData.withdraw.id);
      const REQUEST_URL = "withdraw-fund";
      axios({
        url: REQUEST_URL,
        method: "POST",
        data: formdata,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      })
        .then((response) => {
          if (response.data.status === 401) {
            this.message = "Bad request";
            this.alert = true;
            this.confirming = false;
            return;
          }

          this.confirmSuccess = true;
        })
        .catch((error) => {
          this.error_message =
            "We cannot proccess your request at this time, please try again later";
          this.error_making_withdraw = true;
          this.loading_data = false;
        });
    },

    goBack() {
      this.confirmSuccess = false;
      this.$router.push({ name: "Withdraw" });
    },
  },
  computed: {
    ...mapState("user", ["withdrawData"]),
  },
};
</script>
