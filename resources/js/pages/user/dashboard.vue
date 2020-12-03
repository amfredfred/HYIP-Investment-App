<template>
  <div class="dashboard">
    <div>
      <h3 class="font-bold">Overview</h3>
    </div>

    <section class="mt-16 invoices-dashboard">
      <h4>Invoices</h4>
      <div class="flex flex-wrap mt-4 md:flex-nowrap md:space-x-4 space-x-0 md:space-x-10">
        <div
          class="w-full px-20 py-3 mb-4 text-center text-gray-800 bg-green-100 sm:w-auto rounded-xl shadow-sm total-balance"
        >
          <h3 class="text-xl font-bold">$14,000</h3>
          <h6>Total Balance</h6>
        </div>
        <div
          class="w-full px-20 py-3 mb-4 text-center text-gray-800 bg-green-100 sm:w-auto total-investments rounded-xl shadow-sm"
        >
          <h3 class="text-xl font-bold">$14,000</h3>
          <h6>Total Investments</h6>
        </div>
        <div
          class="w-full px-20 py-3 mb-4 text-center text-gray-800 bg-green-100 sm:w-auto total-withdrawal rounded-xl shadow-sm"
        >
          <h3 class="text-xl font-bold">$14,000</h3>
          <h6>Total Withdrawals</h6>
        </div>
      </div>
    </section>

    <section class="mt-12">
      <!-- Active investments -->
      <h4>Active Investments</h4>
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
  name: "dashboard",
  data() {
    return {
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
