<template>
  <div>
    <h2>Pay</h2>
    <v-container>
      <v-row>
        <v-col cols="12" sm="6" md="3">
          <v-card>
            <div class="bg-green-800 card-header p-7">
              <h3 class="text-gray-100">Amazing Plan</h3>
              <div class="flex justify-between mt-5 text-green-100">
                <span>Min: $100.00</span>
                <span>Max: $1000.00</span>
              </div>
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
