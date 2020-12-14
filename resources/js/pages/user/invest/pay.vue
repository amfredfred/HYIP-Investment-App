<template>
  <div>
    <h2 class="text-gray-600">Pay</h2>
    <v-container class="mt-10">
      <v-row>
        <v-col cols="12" sm="6" md="3">
          <v-card>
            <v-card-title class="text-lg font-bold text-green-500">Amazing Plan</v-card-title>
            <div class="card-body">
              <div class="plan-features">
                <div class="flex justify-between pb-3 mb-12 border-pink-500 feature">
                  <span class="text-base text-gray-600">Min</span>
                  <span class="text-lg font-bold text-gray-700">$100</span>
                </div>

                <div class="flex justify-between pb-3 mb-12 border-pink-500 feature">
                  <span class="text-base text-gray-600">Max</span>
                  <span class="text-lg font-bold text-gray-700">$100</span>
                </div>

                <div class="flex justify-between pb-3 mb-12 border-pink-500 feature">
                  <span class="text-base text-gray-600">Interest</span>
                  <span class="text-lg font-bold text-gray-700">5%</span>
                </div>
              </div>
            </div>

            <div class="p-10 mx-0 deep-purple darken-2 deep-purple--text text--lighten-5">
              <h5 class="font-bold">Current Balance</h5>
              <span class="block text-3xl font-bold">$0.0</span>
            </div>
          </v-card>
        </v-col>
        <v-col cols="12" sm="6" md="9">
          <v-form>
            <v-text-field outlined type="number" label="Amount"></v-text-field>
            <v-select
              :items="withdrawalMethod"
              item-text="name"
              item-value="abbr"
              label="Payment Method"
              single-line
              outlined
            ></v-select>

            <v-btn class="bg-blue-600 text-blue-50">Make Deposit</v-btn>
          </v-form>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>
<script>
export default {
  name: "pay",
  data() {
    return {
      withdrawalMethod: [
        { name: "Bitcoin", abbr: "btc" },
        { name: "Etherum", abbr: "eth" },
      ],
    };
  },
};
</script>
<style lang="scss" scoped>
.plan-features {
  .feature {
    border-bottom: 2px solid;
  }
}
</style>
