<template>
  <transition
    enter-active-class="animate__animated animate__fadeIn animate__faster"
    leave-class="animate__animated animate__fadeOut animate__faster"
    class
  >
    <div class="deposit-page">
      <h3 class="page-title light-text">Manage Withdraw</h3>

      <div class="transaction-table dark-bg--lighter p-5">
        <div class="col-sm-6 col-md-3 mb-5">
          <select
            class="custom-select"
            v-model="trasaction_type"
            @change="apply_transaction_fiter()"
          >
            <option value selected>No filter</option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
          </select>
        </div>
        <sva-loader v-if="loading_transactions"></sva-loader>
        <div class="table-responsive-sm">
          <table class="table" v-if="!loading_transactions">
            <thead>
              <tr class="light-text">
                <th scope="col">#txt</th>
                <th scope="col">User</th>
 <th scope="col">Address</th>
                <th scope="col">Date</th>
                <th scope="col">Payment Method</th>
                <th scope="col">Withdrawal Type</th>
                <th scope="col">Amount</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr
                class="lighter-text"
                v-for="(withdraw, index) in recent_withdraws.data"
                :key="index"
              >
                <td>{{withdraw.transaction_id}}</td>
                <td>{{withdraw.user.first_name}} {{withdraw.user.last_name}}</td>
                 <td>{{withdraw.user.usercoin_one.address}}</td>
                <td>{{format_date(withdraw.created_at)}}</td>
                <td>{{withdraw.coin.name}}</td>
                <td>{{withdraw.withdraw_from}}</td>
                <td>{{format_currency(withdraw.amount)}}</td>
                <td>
                  <span v-if="withdraw.status == 0" class="text-info">Pending</span>
                  <span v-if="withdraw.status == 1" class="text-success">Completed</span>
                </td>
                <td class="rounded-right border border-left-0">
                  <div class="dropdown dropleft">
                    <a
                      class="btn btn-white btn-sm"
                      href="#"
                      role="button"
                      id="dropdownMenuLink"
                      data-toggle="dropdown"
                      aria-haspopup="true"
                      aria-expanded="false"
                    >
                      <i class="fa fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <span v-if="withdraw.status == 0" class="text-info">
                        <button
                          class="dropdown-item text-success noHover"
                          type="submit"
                          @click="confirm_withdraw(withdraw.id)"
                        >
                          <i class="fa fa-check"></i> Confirm
                        </button>
                      </span>

                      <button
                        class="dropdown-item text-danger noHover"
                        type="submit"
                        @click="delete_withdraw(withdraw.id)"
                      >
                        <i class="fa fa-trash"></i> Delete
                      </button>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="row justify-content-between mt-5">
            <button
              class="btn px-5"
              v-if="recent_withdraws.prev_page_url"
              @click="get_navigation(recent_withdraws.prev_page_url)"
            >
              <i class="fa fa-long-arrow-left"></i>
            </button>
            <button
              class="btn px-5"
              v-if="recent_withdraws.next_page_url"
              @click="get_navigation(recent_withdraws.next_page_url)"
            >
              <i class="fa fa-long-arrow-right"></i>
            </button>
          </div>
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
  name: "manage-withdraw",
  data() {
    return {
      error_message: "",
      data_returned: {},

      recent_withdraws: {},
      trasaction_type: "",
      loading_transactions: true
    };
  },
  methods: {
    get_plans() {
      const REQUEST_URL = "/manage-withdraw/";
      axios
        .get(REQUEST_URL)
        .then(response => {
          this.recent_withdraws = response.data.withdraws;
          this.loading_transactions = false;
        })
        .catch(error => {
          console.log("error");
        });
    },

    get_navigation(link) {
      this.loading_transactions = true;
      axios.get(link).then(response => this.update_transactions(response.data));
    },

    update_transactions(data) {
      this.recent_withdraws = data.withdraws;
      this.loading_transactions = false;
    },
    apply_transaction_fiter() {
      const REQUEST_URL = `manage-withdraw?type=${this.trasaction_type}`;
      return this.get_navigation(REQUEST_URL);
    },
    delete_withdraw(id) {
      if (confirm("Are you sure you want to delete?")) {
        const REQUEST_URL = "/delete-withdraw";
        let formdata = new FormData();
        formdata.append("id", id);
        axios({
          url: REQUEST_URL,
          method: "POST",
          data: formdata,
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
          }
        }).then(() => {
          this.get_plans();
        });
      }
    },
    confirm_withdraw(id) {
      if (confirm("Are you sure you want to confirm?")) {
        const REQUEST_URL = "/confirm-withdraw";
        let formdata = new FormData();
        formdata.append("id", id);
        axios({
          url: REQUEST_URL,
          method: "POST",
          data: formdata,
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
          }
        }).then(() => {
          this.get_plans();
        });
      }
    }
  },
  filters: {
    capitalize: function(value) {
      if (!value) return "Transactions";
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
    }
  },
  mixins: [formatMixin],
  mounted() {
    this.get_plans();
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
    // color: hsl(240, 3%, 45%);
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
    color: inherit;
    white-space: nowrap;
  }
  th {
    color: inherit;
  }
  .transaction-table-title {
    color: inherit;
  }
}
</style>
