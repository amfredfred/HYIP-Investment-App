<template id="setting">
  <div>
    <h3 class="text-gray-600">Edit Profile</h3>

    <section class="mt-8 edit-profile">
      <div class="rounded-lg shadow-sm bg-gray-50">
        <v-form @submit.prevent="collect_form_data()" ref="form">
          <v-container>
            <v-row>
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="form.firstname" label="First name"></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="form.lastname" label="Last name"></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field type="email" v-model="form.email" label="E-mail"></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="form.password" type="password" label="Password"></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field
                  v-model="form.confirmPassword"
                  type="password"
                  label="Confirm Password"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row class="mt-12">
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="form.btcAddress" label="Bitcoin Address"></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="form.ethAddress" label="Etherum Address"></v-text-field>
              </v-col>

              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="form.ltcAddress" label="Litecoin Address"></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="form.bchAddress" label="Bitcoin Cash"></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="form.dashAddress" label="Dash Address"></v-text-field>
              </v-col>
            </v-row>
            <div class="mt-5">
              <v-btn dark type="submit" color="green darken-2">Update Profile</v-btn>
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
    form: {
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
    },

    userDetail: [],
    country: [],
    paymentMethod: [],
    selectedCountry: "",
    enable2factor: "no",
    updating_profile: false,
  }),

  methods: {
    user_setting() {
      const REQUEST_URL = "/edit_account/";
      axios
        .get(REQUEST_URL)
        .then((response) => {
          this.userDetail = response.data.user;
          this.country = response.data.country;
          this.paymentMethod = response.data.payment_method;
          this.selectedCountry = this.userDetail.country;

          this.setFormValues();

          if (parseInt(this.userDetail.google2fa_secret_status) === 1) {
            this.enable2factor = "yes";
          }
        })
        .catch((error) => {
          console.log("error");
        });
    },

    setFormValues() {
      this.form.firstname = this.userDetail.first_name;
      this.form.lastname = this.userDetail.last_name;
      this.form.email = this.userDetail.email;
    },

    collect_form_data() {
      this.updating_profile = true;
      const formdata = new FormData();
      this.paymentMethod.forEach((pmethod) => {
        formdata.append(pmethod.coin.slug, pmethod.address);
      });
      const completeForm = this.appendFormData(formdata);
      this.update_profile(completeForm);
    },

    appendFormData(formdata) {
      Object.keys(this.form).forEach((key) =>
        formdata.append(key, this.form[key])
      );
      return formdata;
    },

    update_profile(formdata) {
      const REQUEST_URL = "edit_account";
      axios({
        url: REQUEST_URL,
        method: "POST",
        data: formdata,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
      }).then((response) => {
        if (parseInt(response.data.status) === 401) {
          return this.display_profile_error(response.data.message);
        }
        this.message_type = "success";
        this.updating_profile = false;
        this.message = "Profile Updated";
      });
    },
    display_profile_error(error_message) {
      Object.keys(error_message).forEach((error) => {
        let message = error_message[error];
        this.message_type = "danger";
        this.updating_profile = false;
        message.forEach((mes) => {
          this.message = mes;
        });
      });
    },
    toggle2factorAuth(state) {
      if (state === "yes") {
        return this.enable2factorAuth();
      } else if (state === "no") {
        this.disable2factorAuth();
      } else {
        return;
      }
    },
    enable2factorAuth() {
      if (this.enable2factor === "no") {
        return;
      }
      const REQUEST_URL = "/2fa/enable";
      axios.get(REQUEST_URL).then((response) => {
        const data = response.data;
        if (data.check_status === "1") {
          this.$router.push({
            name: "2factorsuccess",
            query: { secret: data.secret, qr_code: data.image },
          });
        }
      });
    },
    disable2factorAuth() {
      if (this.enable2factor === "yes") {
        return;
      }
      const REQUEST_URL = "/2fa/disable";
      axios.get(REQUEST_URL);
    },
  },
  mounted() {
    this.user_setting();
  },
};
</script>
