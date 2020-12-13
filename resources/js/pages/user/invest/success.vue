<template>
  <div class="success-deposit">
    <div class="m-auto md:w-8/12">
      <v-sheet class="p-5 shadow-lg rounded-xl md:p-8">
        <v-row justify="space-between">
          <v-col cols="12" md="7">
            <h1 class="font-bold text-green-900">Great! Investment has been Made.</h1>
            <p
              class="text-lg text-gray-600 mt-7"
            >Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid nam accusamus nesciunt eos.</p>

            <v-btn class="text-green-100 bg-green-800" :to="{name: 'Dashboard'}">
              Back to home
              <v-icon class="ml-4">fa fa-home</v-icon>
            </v-btn>
          </v-col>
          <v-col class="hidden md:block" md="4">
            <v-img src="/assets/images/undraw_Nature_benefits_re_kk70.svg"></v-img>
          </v-col>
        </v-row>
      </v-sheet>
    </div>
  </div>
</template>
<script>
export default {
  name: "successInvest",
};
</script>
