<template>
  <transition
    enter-active-class="animate__animated animate__fadeIn animate__faster"
    leave-class="animate__animated animate__fadeOut animate__faster"
    class
  >
    <div class="deposit-page">
      <h3 class="page-title lighter-text">Web Settings</h3>
      <sva-loader v-if="updating_websettings"></sva-loader>
      <div class="mt-5">
        <div
          class="col-md-7 col-sm-8 m-auto p-5 dark-bg--lighter lighter-text mt-5"
          v-if="!updating_websettings"
        >
          <form method="post" @submit.prevent="update_websettings($event.target)">
            <div class="form-group">
              <label>Site Name</label>
              <input
                type="text"
                name="site_name"
                v-model="settings.site_name"
                class="form-control"
                placeholder="Enter Site  Name"
              />
            </div>
            <div class="form-group">
              <label>Site Phone Number</label>
              <input
                type="text"
                name="site_phone"
                v-model="settings.site_phone"
                class="form-control"
                placeholder="Enter Site Phone Number"
              />
            </div>
            <div class="form-group">
              <label>Site Url</label>
              <input
                type="text"
                name="site_url"
                v-model="settings.site_url"
                class="form-control"
                placeholder="Enter Site Url"
              />
            </div>
            <div class="form-group">
              <label>Site Email</label>
              <input
                type="text"
                name="site_email"
                v-model="settings.site_email"
                class="form-control"
                placeholder="Site Email"
              />
            </div>
            <div class="form-group">
              <label>Site Send Notify Email</label>
              <input
                type="text"
                name="send_notify_email"
                v-model="settings.send_notify_email"
                class="form-control"
                placeholder="site Notify Email"
              />
            </div>

            <div class="form-group">
              <label>Address</label>
              <textarea
                type="text"
                name="address"
                v-model="settings.address"
                class="form-control"
                placeholder="Address"
              ></textarea>
            </div>
            <div class="form-group">
              <label>Site Short Code Name</label>
              <input
                type="text"
                name="site_code"
                v-model="settings.site_code"
                class="form-control"
                placeholder="site short code name"
              />
            </div>
            <div class="form-group">
              <label>Site Location</label>
              <input
                type="text"
                name="location"
                v-model="settings.location"
                class="form-control"
                placeholder="Location"
              />
            </div>
            <div class="form-group">
              <video width="200" height="50" controls>
                <source :src="settings.video_1" type="video/mp4" />
                <source :src="settings.video_1" type="video/ogg" />Your browser does not support the video tag.
              </video>
              <label>Site Video 1</label>
              <input type="file" name="video_1" class="form-control" />
            </div>
            <div class="form-group">
              <video width="200" height="50" controls>
                <source :src="settings.video_2" type="video/mp4" />
                <source :src="settings.video_2" type="video/ogg" />Your browser does not support the video tag.
              </video>
              <label>Site Video 2</label>
              <input type="file" name="video_2" class="form-control" />
            </div>
            <div class="form-group">
              <label>Site Copy Right Name</label>
              <input
                type="text"
                name="copy_right"
                v-model="settings.copy_right"
                class="form-control"
                placeholder="Copy Right"
              />
            </div>
            <div class="form-group">
              <label>Deposite Charge</label>
              <input
                type="text"
                name="deposit_investment_charge"
                v-model="settings.deposit_investment_charge"
                class="form-control"
                placeholder="Deposit Charge"
              />
            </div>
            <div class="form-group">
              <label>Minimum Withdraw</label>
              <input
                type="text"
                name="min_withdraw"
                v-model="settings.min_withdraw"
                class="form-control"
                placeholder="Minimum Withdraw"
              />
            </div>
            <div class="form-group">
              <label>Withdraw Charge</label>
              <input
                type="text"
                name="withdraw_charge"
                v-model="settings.withdraw_charge"
                class="form-control"
                placeholder="Withdraw Charge"
              />
            </div>
            <div class="form-group">
              <label>Chat Script</label>
              <textarea
                type="text"
                rows="5"
                name="chat_script"
                v-model="settings.chat_script"
                class="form-control"
                placeholder="Chat Script eg twak"
              ></textarea>
            </div>

            <div class="form-group">
              <img class="img-center" :src="settings.img_login_register" width="40" height="40" alt />
              <label>Img Login / Register</label>
              <input type="file" name="img_login_register" class="form-control" />
            </div>
            <div class="form-group">
              <label>BlockIO Secrent Pin</label>
              <input
                type="text"
                name="block_io_pin"
                v-model="settings.block_io_pin"
                class="form-control"
                placeholder="Your Blockio Password"
              />
            </div>

            <div class="form-group">
              <img
                id="footer-logo-img"
                class="img-center"
                :src="settings.logo"
                width="40"
                height="40"
                alt
              />
              <label>Site Logo</label>
              <input type="file" name="logo" class="form-control" />
            </div>
            <div class="form-group">
              <img
                id="footer-logo-img"
                class="img-center"
                :src="settings.favicon"
                width="40"
                height="40"
                alt
              />
              <label>Favicon</label>
              <input type="file" name="favicon" class="form-control" />
            </div>
            <div class="form-group">
              <label class>Investment Payment Mode</label>

              <select name="mode" class="form-control" v-model="mode">
                <option value selected disabled>Select Mode</option>

                <option value="0">7 days</option>
                <option value="1">Compound Date</option>
              </select>
            </div>
            <div class="form-group">
              <label class>Auto Withdraw</label>

              <select name="auto_withdraw" class="form-control" v-model="auto_withdraw">
                <option value selected disabled>Select Mode</option>

                <option value="0">Off</option>
                <option value="1">On</option>
              </select>
            </div>

            <div class="form-group">
              <label>Email Template</label>
              <textarea
                id="area1"
                class="form-control"
                rows="10"
                name="email_body"
                v-model="settings.email_body"
              ></textarea>
            </div>

            <div class="modal-footer justify-content-between">
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
import moment from "moment";

import formatMixin from "../../mixins/formattingMixin";

import svaLoader from "../../components/loader.vue";
import svaBarcode from "../../components/barcode.vue";
import svaAlert from "../../components/alert.vue";

export default {
  name: "setting-page",
  data() {
    return {
      settings: [],
      updating_websettings: false,
      mode: "",
      auto_withdraw: ""
    };
  },
  methods: {
    get_setting() {
      const REQUEST_URL = "/settings/";
      axios
        .get(REQUEST_URL)
        .then(response => {
          this.settings = response.data.setting;
          this.updating_websettings = false;
          this.mode = response.data.setting.investment_payment_mode;
          this.auto_withdraw = response.data.setting.auto_withdraw;
        })
        .catch(error => {
          console.log("error");
        });
    },

    update_transactions(data) {
      this.settings = data.setting;
      this.loading_transactions = false;
    },
    update_websettings(form) {
      this.updating_websettings = true;
      const formdata = new FormData(form);
      axios({
        url: "/settings",
        method: "post",
        data: formdata,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
      }).then(() => {
        this.get_setting();
      });
    }
  },

  mixins: [formatMixin],
  mounted() {
    this.get_setting();
  },

  components: { svaLoader, svaAlert }
};
</script>
<style lang="scss" scoped>
$primary-color: blue;
$link-color: lighten($primary-color, 10);
.select-plan {
  margin-top: 5rem;
  h5:first-child {
    font-size: 1rem;
    color: hsl(240, 2%, 44%);
  }
}
.c-plan {
  transition: background-color 0.3s ease;
  outline-color: $primary-color;
  background-color: #fdfffc;
  .c-plan__heading {
    text-align: center;
    background: linear-gradient(
      128.47deg,
      #ef2354 14.1%,
      rgba(239, 35, 133, 0.9) 76.95%
    );
    color: rgb(250, 236, 239);
    padding: 1.2rem;
    .c-plan__title {
      margin-bottom: 0.7rem;
      h4 {
        font-size: 1.2rem;
      }
    }
    .c-plan__info {
      .c-plan__interest {
        font-size: 3rem;
        .c-plan__interest--percentage {
          font-size: 1.3rem;
        }
      }
    }
  }
  .c-plan-body {
    margin-top: 3rem;
    .c-plan-body__details {
      li {
        text-align: center;
        margin-bottom: 1.3rem;
        border-bottom: 1px solid rgba(173, 166, 166, 0.3);
        color: rgb(129, 129, 129);
      }
    }
  }
  .c-plan-footer {
    margin-top: 3rem;
    .invest-btn {
      text-align: center;
      .btn--invest {
        background-color: $primary-color;
        color: lighten($color: $primary-color, $amount: 40);
        width: 10rem;
        max-width: 100%;
      }
    }
  }
  &:hover {
    cursor: pointer;
    background-color: hsl(124, 100%, 97%);
    color: #133116 !important;
  }
  &.c-plan--selected {
    background-color: hsl(124, 100%, 97%);
    color: #133116 !important;
  }
}

.selected-plan {
  margin-top: 5rem;
  h5:first-child {
    font-size: 1rem;
    color: hsl(240, 2%, 44%);
  }
}
.c-deposit-form {
  background-color: #fdfffc;
  padding: 0.9rem;
  border-radius: 20px;
  label {
    color: hsl(240, 3%, 45%);
  }
  input {
    color: hsl(240, 3%, 45%);
  }
  option {
    color: hsl(240, 3%, 45%);
  }
  .calculate-interest {
    color: hsl(240, 3%, 45%);
  }
  .c-deposit-btn {
    background-color: #3955d1;
    width: 12rem;
    color: #ebedf5;
  }
}
.unselect-btn {
  background-color: hsl(353, 25%, 78%);
  color: hsl(353, 26%, 31%);
}
.current-balance {
  color: rgb(91, 94, 97);
}

.transaction-table {
  background-color: #fdfffc;
  border-radius: 10px;
  margin-top: 5rem;
  td {
    color: hsl(130, 6%, 40%);
    white-space: nowrap;
  }
  th {
    color: hsl(130, 6%, 40%);
  }
  .transaction-table-title {
    color: hsl(130, 6%, 40%);
  }
}
</style>
