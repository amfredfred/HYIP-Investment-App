<template>
  <div class="selectPlan">
    <h1>choose plan</h1>
    <section class="mt-8">
      <v-row>
        <v-col cols="12" md="3" sm="6" v-for="(plan, index) in plans" :key="index">
          <v-card elevation="1" class="p-2 text-green-800 rounded-md bg-green-50">
            <v-card-title>{{plan.name}}</v-card-title>
            <v-card-subtitle>{{plan.price}}</v-card-subtitle>
            <v-card-actions>
              <v-btn
                :to="{name:'payInvest', params: {planId: index}}"
                class="px-4 text-green-100 bg-green-700 rounded-lg"
              >Invest</v-btn>
            </v-card-actions>
          </v-card>
        </v-col>
      </v-row>
    </section>
  </div>
</template>

<script>
export default {
  name: "SelectPlan",
  data() {
    return {
      plans: [
        { name: "Amazing Plan", price: "$100.00" },
        { name: "Unamazing plan", price: "$300" },
      ],
    };
  },
};
</script>
