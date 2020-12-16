<template id="setting">
  <div>
    <h3 class="text-gray-600">Edit Profile</h3>

    <section class="mt-8 edit-profile">
      <div class="rounded-lg shadow-sm bg-gray-50">
        <v-form v-model="valid">
          <v-container>
            <v-row>
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="firstname" label="First name"></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="lastname" label="Last name"></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="email" label="E-mail"></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="password" type="password" label="Password"></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="confirmPassword" type="password" label="Confirm Password"></v-text-field>
              </v-col>
            </v-row>
            <v-row class="mt-12">
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="btcAddress" label="Bitcoin Address"></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="ethAddress" label="Etherum Address"></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="ltcAddress" label="Litecoin Address"></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="bchAddress" label="Bitcoin Cash"></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="dashAddress" label="Dash Address"></v-text-field>
              </v-col>
            </v-row>
            <div class="mt-5">
              <v-btn dark color="green darken-2">Update Profile</v-btn>
            </div>
          </v-container>
        </v-form>
      </div>
    </section>
  </div>
</template>
<script>
export default {
  name: "setting",
  data: () => ({
    valid: false,
    firstname: "",
    lastname: "",
    password: "",
    confirmPassword: "",
    btcAddress: "",
    ethAddress: "",
    ltcAddress: "",
    bchAddress: "",
    dashAddress: "",
  }),
};
</script>
