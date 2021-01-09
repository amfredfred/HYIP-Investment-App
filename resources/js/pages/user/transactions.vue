<template>
  <div class="transactions">
    <h3>Recent Transactions</h3>

    <section class="mt-12">
      <!-- Recent Transactions -->
      <div class="mx-0 mb-5 col-5 col-sm-4 col-md-3">
        <select class="custom-select" v-model="trasaction_type" @change="apply_transaction_fiter()">
          <option value selected>No filter</option>
          <option value="deposit">Deposits</option>
          <option value="withdrawal">Withdrawals</option>
          <option value="earning">Earnings</option>
          <option value="commissions">Referral Bonus</option>
        </select>
      </div>
      <v-data-table
        :headers="tableHeaders"
        :items="transactions.data"
        :items-per-page="10"
        class="elevation-1"
        :loading="loading_transactions"
        loading-text="Loading Transactions"
      >
        <template #item.created_at="{ item }">{{item.created_at | formatDate }}</template>
        <template #item.amount="{ item }">{{item.amount | formatCurrency }}</template>
      </v-data-table>
    </section>
  </div>
</template>
<script>
import formatMixin from "../../mixins/utilitiesMixin";

export default {
  name: "transactions",

  data() {
    return {
      loading_transactions: true,

      transactions: {},
      trasaction_type: "",

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
          text: "Type",
          value: "name_type",
        },
        {
          text: "Amount",
          value: "amount",
        },
        {
          text: "Payment Method",
          value: "coin.name",
        },
      ],
    };
  },

  methods: {
    get_transactions() {
      const REQUEST_URL = "/get_history";
      axios
        .get(REQUEST_URL)
        .then((response) => {
          this.transactions = response.data.histories;
          this.loading_transactions = false;
        })
        .catch((error) => {
          console.log("error");
        });
    },

    get_navigation(link) {
      this.loading_transactions = true;
      axios
        .get(link)
        .then((response) => this.update_transactions(response.data));
    },

    update_transactions(data) {
      this.transactions = data.histories;
      this.loading_transactions = false;
    },

    apply_transaction_fiter() {
      this.loading_transactions = true;
      const REQUEST_URL = `get_history?type=${this.trasaction_type}`;
      return this.get_navigation(REQUEST_URL);
    },
  },
  filters: {
    capitalize: function (value) {
      if (!value) return "Transactions";
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
    },
  },
  mixins: [formatMixin],
  mounted() {
    this.get_transactions();
  },
};
</script>
