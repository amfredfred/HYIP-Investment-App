<template>
  <div class="referral">
    <h2>Referral</h2>
    <section class="mt-12">
      <v-row>
        <v-col cols="12" md="4">
          <div class="rounded-lg shadow p-7 bg-gray-50">
            <div class="referral-summary">
              <div
                class="p-3 mb-3 rounded-xl shadow-sm green--text text--lighten-4 earned green darken-3"
              >
                <div class="flex space-x-5">
                  <v-icon class="text-5xl text--lighten-4 green--text">
                    fa
                    fa-link
                  </v-icon>
                  <div class="total-earned">
                    <h2 class="text-xl font-bold">{{refLink || "No link"}}</h2>
                    <h6>Referral Link</h6>
                  </div>
                </div>
              </div>
              <div
                class="p-3 mb-3 rounded-xl shadow-sm purple--text text--lighten-4 earned purple darken-3"
              >
                <div class="flex space-x-5">
                  <v-icon class="text-5xl text--lighten-4 purple--text">fa fa-podcast</v-icon>
                  <div class="total-earned">
                    <h2 class="font-bold">${{referalEarns}}</h2>
                    <h6>Total Earned</h6>
                  </div>
                </div>
              </div>
              <div
                class="p-3 mb-3 rounded-xl shadow-sm blue--text text--lighten-4 referrals blue darken-3"
              >
                <div class="flex space-x-5">
                  <v-icon class="text-5xl text--lighten-4 blue--text">
                    fa
                    fa-users
                  </v-icon>
                  <div class="total-earned">
                    <h2 class="font-bold">{{totalReferal}}</h2>
                    <h6>Referrals</h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </v-col>
        <v-col cols="12" md="8">
          <!-- Referrals -->
          <v-data-table
            :headers="tableHeaders"
            :items="referrals"
            :items-per-page="5"
            class="elevation-1"
          ></v-data-table>
        </v-col>
      </v-row>
    </section>
  </div>
</template>
<script>
export default {
  name: "Referral",
  data() {
    return {
      totalReferal: 0,
      referrals: [],
      referalEarns: [],
      refLink: "",

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
    };
  },
  methods: {
    user_referal() {
      const REQUEST_URL = "/referals/";
      axios
        .get(REQUEST_URL)
        .then((response) => {
          this.referalEarns = response.data.commission;
          this.totalReferal = response.data.refs_count;
          this.referrals = response.data.referal;
          this.refLink = response.data.ref_link;
        })
        .catch((error) => {
          console.log("error");
        });
    },
  },
  mounted() {
    this.user_referal();
  },
};
</script>
