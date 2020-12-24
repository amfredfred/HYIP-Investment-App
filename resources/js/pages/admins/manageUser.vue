<template>
  <transition
    enter-active-class="animate__animated animate__fadeIn animate__faster"
    leave-class="animate__animated animate__fadeOut animate__faster"
    class
  >
    <div class="deposit-page">
      <h3 class="page-title light-text">Manage Users</h3>

      <div class="p-5 transaction-table dark-bg--lighter">
        <div class="row">
          <div class="mb-5 col-sm-6 col-md-3">
            <select class="custom-select" v-model="user_type" @change="apply_user_fiter()">
              <option value selected>No filter</option>
              <option value="verified">Verified</option>
              <option value="unverified">Unverified</option>
            </select>
          </div>

          <div class="mb-5 col-sm-10 col-md-7">
            <form class="my-2 form-inline my-lg-0">
              <input
                class="form-control mr-sm-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="my-2 btn btn-outline-primary my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </div>
        <button
          type="button"
          class="mb-5 btn btn-theme btn-circle btn-success"
          data-toggle="modal"
          data-target="#modal-default"
        >Add New Users</button>
        <div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add User</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <sva-loader v-if="updating_user"></sva-loader>
                <div v-if="message.length > 0 " class="mb-4">
                  <sva-alert
                    v-for="(mes, index) in message"
                    :key="index"
                    :message="mes"
                    :type="message_type"
                  ></sva-alert>
                </div>
                <form method="post" @submit.prevent="add_user($event.target)" v-if="!updating_user">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          id="first_name"
                          type="text"
                          name="first_name"
                          value
                          class="form-control"
                          placeholder="First name"
                          required="required"
                          data-error="Fullname is required."
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          id="last_name"
                          type="text"
                          name="last_name"
                          value
                          class="form-control"
                          placeholder="Last name"
                          required="required"
                          data-error="Fullname is required."
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          id="phone_no"
                          type="text"
                          name="phone_no"
                          class="form-control"
                          placeholder="Phone Number"
                          required="required"
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          id="password"
                          type="password"
                          name="password"
                          value
                          class="form-control"
                          placeholder="Password"
                          required="required"
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          id="email"
                          type="text"
                          name="email"
                          value
                          class="form-control"
                          placeholder="Email"
                          required="required"
                        />

                        <div class="help-block with-errors"></div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          size="30"
                          name="bitcoin_address"
                          data-validate-notice="Bitcoin Address"
                          placeholder="Bitcoin Account"
                        />

                        <div class="help-block with-errors"></div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <select name="type" class="form-control">
                          <option value selected disabled>Select User Type</option>
                          <option value="admin">Admin</option>
                          <option value="user">User</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <select name="country" class="form-control">
                          <option value selected disabled>Select Country</option>
                          <option
                            value="admin"
                            v-for="country in country"
                            :key="country"
                            v-text="country"
                          ></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-theme btn-circle">Add</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Edit user modal -->
        <div class="modal fade" id="modal-edituser">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Edit User</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <div v-if="message.length > 0 " class="mb-4">
                  <sva-alert
                    v-for="(mes, index) in message"
                    :key="index"
                    :message="mes"
                    :type="message_type"
                  ></sva-alert>
                </div>
                <form method="post" @submit.prevent="edit_user($event.target)">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          id="e_first_name"
                          type="text"
                          name="first_name"
                          value
                          class="form-control"
                          placeholder="First name"
                          data-error="First is required."
                          v-model="edituser.first_name"
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          id="e_last_name"
                          type="text"
                          name="last_name"
                          value
                          class="form-control"
                          placeholder="Last name"
                          data-error="Last anme is required."
                          v-model="edituser.last_name"
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          id="e_phone_no"
                          type="text"
                          name="phone_no"
                          class="form-control"
                          placeholder="Phone Number"
                          v-model="edituser.phone_no"
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          id="e_password"
                          type="password"
                          name="password"
                          value
                          class="form-control"
                          placeholder="Password"
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          id="e_email"
                          type="text"
                          name="email"
                          value
                          class="form-control"
                          placeholder="Email"
                          v-model="edituser.email"
                        />

                        <div class="help-block with-errors"></div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <input
                          type="text"
                          class="form-control"
                          size="30"
                          name="bitcoin_address"
                          data-validate-notice="Bitcoin Address"
                          placeholder="Bitcoin Account"
                        />

                        <div class="help-block with-errors"></div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <select
                          name="type"
                          class="form-control custom-select"
                          v-model="edituser.type"
                        >
                          <option value selected disabled>Select User Type</option>
                          <option value="admin">Admin</option>
                          <option value="user">User</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <select
                          name="country"
                          class="form-control custom-selecy"
                          v-model="edituser.country"
                        >
                          <option value selected disabled>Select Country</option>
                          <option v-for="country in country" :key="country" v-text="country"></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-theme btn-circle">Edit</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- Edit user modal end -->
        <sva-loader v-if="loading_transactions || loading_referrals"></sva-loader>
        <div class="table-responsive-sm">
          <table
            class="table"
            v-if="!loading_transactions &&
            !loading_referrals && !shown_referrals"
          >
            <thead>
              <tr class="lighter-text">
                <th scope="col">S/No</th>
                <th scope="col">User</th>
                <th scope="col">Email</th>
                <th scope="col">Phone No</th>
                <th scope="col">Type</th>
                <th scope="col">Date Joined</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(user, index) in users.data"
                :key="index"
                class="light-text"
                @click="get_referrals(user.id)"
              >
                <td>{{index +1}}</td>
                <td>{{user.first_name}} {{user.last_name}}</td>
                <td>{{user.email}}</td>
                <td>{{user.phone_no}}</td>
                <td>{{user.type}}</td>
                <td>{{format_date(user.created_at)}}</td>
                <td>
                  <span v-if="user.code == 0" class="text-info">Unverified</span>
                  <span v-if="user.code == 1" class="text-success">Verified</span>
                </td>

                <td class="border rounded-right border-left-0">
                  <div class="dropdown dropleft">
                    <a
                      class="btn btn-white light-text btn-sm"
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
                      <span v-if="user.code == 0" class="text-info">
                        <button
                          class="dropdown-item text-success noHover"
                          type="button"
                          @click="confirm_user(user.id)"
                        >
                          <i class="fa fa-check"></i> Verify User
                        </button>
                      </span>
                      <button
                        class="dropdown-item text-success noHover"
                        data-toggle="modal"
                        data-target="#modal-edituser"
                        @click="set_edituser(index)"
                      >
                        <i class="fa fa-edit"></i> Edit
                      </button>
                      <span v-if="user.google2fa_secret_status == 1" class="text-info">
                        <button class="dropdown-item text-primary noHover" type="button">
                          <i class="fa fa-remove"></i> Remove 2factor
                        </button>
                      </span>

                      <button
                        class="dropdown-item text-danger noHover"
                        @click="delete_user(user.id)"
                        type="button"
                      >
                        <i class="fa fa-trash"></i> Delete
                      </button>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
          <div class="mt-5 row justify-content-between">
            <button
              class="px-5 btn"
              v-if="users.prev_page_url"
              @click="get_navigation(users.prev_page_url)"
            >
              <i class="fa fa-long-arrow-left"></i>
            </button>
            <button
              class="px-5 btn"
              v-if="users.next_page_url"
              @click="get_navigation(users.next_page_url)"
            >
              <i class="fa fa-long-arrow-right"></i>
            </button>
          </div>

          <!-- showing referrals -->
          <table
            class="table"
            v-if="!loading_referrals &&
            !loading_transactions && shown_referrals"
          >
            <thead>
              <tr class="lighter-text">
                <th scope="col">S/No</th>
                <th scope="col">User</th>
                <th scope="col">Email</th>
                <th scope="col">Phone No</th>
                <th scope="col">Type</th>
                <th scope="col">Date Joined</th>
                <th scope="col">Status</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(user, index) in referrals" :key="index" class="light-text">
                <td>{{index +1}}</td>
                <td>{{user.first_name}} {{user.last_name}}</td>
                <td>{{user.email}}</td>
                <td>{{user.phone_no}}</td>
                <td>{{user.type}}</td>
                <td>{{format_date(user.created_at)}}</td>
                <td>
                  <span v-if="user.code == 0" class="text-info">Unverified</span>
                  <span v-if="user.code == 1" class="text-success">Verified</span>
                </td>

                <td class="border rounded-right border-left-0">
                  <div class="dropdown dropleft">
                    <a
                      class="btn btn-white light-text btn-sm"
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
                      <span v-if="user.code == 0" class="text-info">
                        <button
                          class="dropdown-item text-success noHover"
                          type="button"
                          @click="confirm_user(user.id)"
                        >
                          <i class="fa fa-check"></i> Verify User
                        </button>
                      </span>
                      <button
                        class="dropdown-item text-success noHover"
                        data-toggle="modal"
                        data-target="#modal-edituser"
                        @click="set_edituser(index)"
                      >
                        <i class="fa fa-edit"></i> Edit
                      </button>
                      <span v-if="user.google2fa_secret_status == 1" class="text-info">
                        <button class="dropdown-item text-primary noHover" type="button">
                          <i class="fa fa-remove"></i> Remove 2factor
                        </button>
                      </span>

                      <button
                        class="dropdown-item text-danger noHover"
                        @click="delete_user(user.id)"
                        type="button"
                      >
                        <i class="fa fa-trash"></i> Delete
                      </button>
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
import moment from "moment";

import formatMixin from "../../mixins/formattingMixin";
import messageMixin from "../../mixins/messageMixin";

import svaLoader from "../../components/loader.vue";
import svaBarcode from "../../components/barcode.vue";
import svaAlert from "../../components/alert.vue";

export default {
  name: "deposit-page",
  data() {
    return {
      error_message: "",
      data_returned: {},

      users: {},
      user_type: "",

      referrals: [],
      loading_referrals: false,
      shown_referrals: false,

      loading_transactions: true,

      edituser: {},
      country: [],
      updating_user: false,
    };
  },
  methods: {
    get_users() {
      const REQUEST_URL = "/users/";

      axios
        .get(REQUEST_URL)
        .then((response) => {
          this.users = response.data.user_details;
          this.loading_transactions = false;
          this.country = response.data.country;
        })
        .catch((error) => {
          console.log("error");
        });
    },

    get_referrals(referral_user_id) {
      this.loading_referrals = true;

      const REQUEST_URL = `/referrals/${referral_user_id}`;

      axios
        .get(REQUEST_URL)
        .then((response) => {
          this.referrals = response.data.user_details;
          this.shown_referrals = true;
          this.loading_referrals = false;

          this.country = response.data.country;
        })
        .catch((error) => {
          console.log("error");
        });
    },

    set_edituser(index) {
      this.edituser = this.users.data[index];
    },

    get_navigation(link) {
      this.loading_transactions = true;
      axios
        .get(link)
        .then((response) => this.update_transactions(response.data));
    },

    update_transactions(data) {
      this.users = data.user_details;
      this.loading_transactions = false;
    },

    apply_user_fiter() {
      const REQUEST_URL = `users?type=${this.user_type}`;
      return this.get_navigation(REQUEST_URL);
    },

    delete_user(id) {
      if (confirm("Are you sure you want to delete?")) {
        const REQUEST_URL = "/delete-user";

        let formdata = new FormData();
        formdata.append("id", id);

        axios({
          url: REQUEST_URL,
          method: "POST",
          data: formdata,
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
        }).then(() => {
          this.get_users();
        });
      }
    },

    edit_user(form) {
      if (confirm("Are you sure you want to update this user??")) {
        this.message = [];
        this.message_type = "info";
        this.message.push("Updating ...");
        const REQUEST_URL = "/edit-user";

        let formdata = new FormData(form);
        formdata.append("id", this.edituser.id);

        axios({
          url: REQUEST_URL,
          method: "POST",
          data: formdata,
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
        })
          .then((response) => {
            if (parseInt(response.data.status) === 401) {
              return this.display_error(response.data.message);
            }
            this.message = [];
            this.message_type = "success";
            this.message.push("User updated successfully");
            form.reset();
            this.get_users();
          })
          .catch(() => {
            this.message = [];
            this.message_type = "danger";
            this.message.push("Cannot update user");
          });
      }
    },

    confirm_user(id) {
      if (confirm("Are you sure you want to verify this user?")) {
        const REQUEST_URL = "/verify-user";

        let formdata = new FormData();
        formdata.append("id", id);

        axios({
          url: REQUEST_URL,
          method: "POST",
          data: formdata,
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
        }).then(() => {
          this.get_users();
        });
      }
    },

    add_user(form) {
      if (confirm("Add user?")) {
        this.message = [];
        this.message_type = "info";
        this.message.push("creating");

        const REQUEST_URL = "/add-user";
        let formdata = new FormData(form);
        axios({
          url: REQUEST_URL,
          method: "POST",
          data: formdata,
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
          },
        })
          .then((response) => {
            if (parseInt(response.data.status) === 401) {
              return this.display_error(response.data.message);
            }
            this.message = [];
            this.message_type = "success";
            this.message.push("User added successfully");
            form.reset();
            this.updating_user = false;
            this.get_users();
            $("#modal-default").modal("hide");
          })
          .catch(() => {
            this.message = [];
            this.message_type = "danger";
            this.message.push("Cannot update user");
          });
      }
    },
  },

  filters: {
    capitalize: function (value) {
      if (!value) return "Transactions";
      value = value.toString();
      return value.charAt(0).toUpperCase() + value.slice(1);
    },
  },

  mixins: [formatMixin, messageMixin],

  mounted() {
    this.get_users();
  },

  components: { svaLoader, svaAlert },
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
