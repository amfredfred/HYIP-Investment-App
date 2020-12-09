<template>
  <div class="withdraw">
    <section class="request-withdraw">
      <div class="mx-auto md:w-6/12 sm:w-8/12">
        <h4 class="mb-4">Withdraw funds</h4>

        <v-form>
          <v-text-field v-model="form.amount" color="blue darken-2" label="Amount" required></v-text-field>
          <v-select
            v-model="select"
            :items="withdrawAccount"
            label="Withdrawal Account"
            return-object
            single-line
            outlined
          ></v-select>
          <v-select
            :items="withdrawalMethod"
            item-text="name"
            item-value="abbr"
            label="Payment Method"
            single-line
            outlined
          ></v-select>
          <v-btn color="blue darken-3 large blue--text text--lighten-5">
            Request Withdrawal
            <v-icon class="ml-2 text-lg">fa fa-credit-card</v-icon>
          </v-btn>
        </v-form>
      </div>
    </section>

    <section class="mt-12">
      <!-- Recent Withdrawals -->
      <h4>Recent Withdrawals</h4>
      <v-data-table
        :headers="tableHeaders"
        :items="transactions"
        :items-per-page="5"
        class="elevation-1"
      ></v-data-table>
    </section>
  </div>
</template>
<script>
export default {
  name: "withdraw",
  data() {
    return {
      form: {
        amount: "",
        balance: "",
        method: "",
      },

      withdrawalMethod: [
        { name: "Bitcoin", abbr: "btc" },
        { name: "Etherum", abbr: "eth" },
      ],

      withdrawAccount: ["Main", "Referral", "Bonus"],

      tableHeaders: [
        {
          text: "Date",
          value: "date",
        },
        {
          text: "Withdrawal Method",
          value: "method",
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

      transactions: [
        {
          date: "20-22-10",
          method: "Bitcoin",
          amount: "$200,00",
          status: "Pending",
        },
      ],
    };
  },
};
</script>
