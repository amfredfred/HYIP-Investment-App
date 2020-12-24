<template>
  <div class="confirm-2factor">
    <div class="col-md-6 bg-white p-4 col-sm-7 m-auto">
      <div class="text-center">
        <img :src="qr_code" alt="qr code" class="img-fluid barcode-image" />
        <p class="gr-code-text mt-2 mb-0">{{secret}}</p>
        <sva-copy class="mt-0" :text="secret" />
      </div>
      <div class="mt-5 code-instruction">
        <span>Open your 2FA Mobile App and Scan the QR Above, or Alternatively, you can copy and paste the generated code inside the 2FA app. We recommend the Google Authenticator app but you can use any 2FA app of your choice</span>
        <div class="m-auto col-md-4">
          <a
            href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2&hl=en"
            class="d-inline-block text-center mr-3"
          >
            <img
              src="/assets/images/google2fa.webp"
              class="img-fluid auth-logo"
              alt="Google Authenticator"
            />
            <br />Android
          </a>
          <a
            href="https://apps.apple.com/us/app/google-authenticator/id388497605"
            class="d-inline-block text-center"
          >
            <img
              src="/assets/images/google2fa.webp"
              class="img-fluid auth-logo"
              alt="Google Authenticator"
            />
            <br />IOS
          </a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import svaCopy from "../../components/copyClipboard.vue";
export default {
  name: "enable-2factor",
  data() {
    return {
      secret: "",
      qr_code: ""
    };
  },
  methods: {
    get_data_from_url() {
      this.secret = this.$route.query.secret;
      this.qr_code = this.$route.query.qr_code;
    }
  },
  mounted() {
    this.get_data_from_url();
  },
  components: { svaCopy }
};
</script>

<style lang="scss" scoped>
.barcode-image {
  width: 10rem;
}

.auth-logo {
  width: 3rem;
}
.code-instruction {
  color: hsl(130, 6%, 40%);
  a {
    color: inherit;
    &:hover {
      text-decoration: inherit;
    }
  }
}
</style>
