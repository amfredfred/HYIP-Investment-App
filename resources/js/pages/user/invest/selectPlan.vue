<template>
  <div class="selectPlan">
    <h1 class="font-bold text-gray-600">choose plan</h1>
    <section class="mt-8">
      <v-row>
        <v-col cols="12" md="4" sm="6" v-for="(plan, index) in plans" :key="index">
          <v-card elevation="1" class="text-gray-800 rounded-md bg-gray-50">
            <v-card-title class="text-lg font-bold text-green-500">{{plan.name}}</v-card-title>
            <div class="card-body">
              <div class="plan-features">
                <div class="flex justify-between pb-3 mb-12 border-pink-500 feature">
                  <span class="text-base text-gray-600">Min</span>
                  <span class="text-lg font-bold text-gray-700">{{plan.min | formatCurrency}}</span>
                </div>

                <div class="flex justify-between pb-3 mb-12 border-pink-500 feature">
                  <span class="text-base text-gray-600">Max</span>
                  <span class="text-lg font-bold text-gray-700">{{plan.max | formatCurrency}}</span>
                </div>

                <div class="flex justify-between pb-3 mb-12 border-pink-500 feature">
                  <span class="text-base text-gray-600">Interest</span>
                  <span class="text-lg font-bold text-gray-700">{{plan.percentage}}%</span>
                </div>
              </div>
            </div>

            <v-card-actions class="p-10 mx-0 bg-gray-100">
              <v-btn :to="{name:'payInvest', params: {planId: index}}" text color="amber darken-4">
                Invest
                <v-icon class="ml-4">fa fa-long-arrow-right</v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </section>
  </div>
</template>

<script>
import { mapGetters } from "vuex";

import utilitiesMixin from "../../../mixins/utilitiesMixin";
import userInformationMixin from "../../../mixins/userInformation";

export default {
  name: "SelectPlan",
  data() {
    return {};
  },

  methods: {},

  mixins: [utilitiesMixin, userInformationMixin],

  computed: {
    ...mapGetters("user", ["plans"]),
  },

  mounted() {},
};
</script>

<style lang="scss" scoped>
.plan-features {
  .feature {
    border-bottom: 2px solid;
  }
}
</style>
