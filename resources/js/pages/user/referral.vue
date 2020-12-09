<template>
  <div class="referral">
    <h2>Referral</h2>
    <section class="mt-12">
      <!-- Referrals -->
      <v-data-table
        :headers="tableHeaders"
        :items="referrals"
        :items-per-page="5"
        class="elevation-1"
      ></v-data-table>
    </section>
  </div>
</template>
<script>
export default {
  name: "Referral",
  data() {
    return {
      tableHeaders: [
        {
          text: "Date",
          value: "date",
        },
        {
          text: "Referral Name",
          value: "name",
        },

        {
          text: "Status",
          value: "status",
        },
      ],

      referrals: [
        {
          date: "20-22-10",
          name: "Felipe Luiz",
          status: "Pending",
        },
      ],
    };
  },
};
</script>
