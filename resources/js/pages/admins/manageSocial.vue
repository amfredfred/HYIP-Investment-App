<template>
  <transition
    enter-active-class="animate__animated animate__fadeIn animate__faster"
    leave-class="animate__animated animate__fadeOut animate__faster"
    class
  >
    <div class="deposit-page">
      <h3 class="page-title lighter-text">Manage Socials</h3>

      <div class="transaction-table p-5 dark-bg--lighter">
        <button
          type="button"
          class="btn btn-theme btn-circle btn-success mb-5"
          data-toggle="modal"
          data-target="#modal-default"
        >Add New Social</button>

        <div class="modal fade" id="modal-default">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add Social</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <div v-if="message.length > 0">
                  <sva-alert
                    v-for="(mes, index) in message"
                    :key="index"
                    :message="mes"
                    :type="message_type"
                  ></sva-alert>
                </div>
                <sva-loader v-if="updating_social"></sva-loader>
                <form
                  method="post"
                  @submit.prevent="add_social($event.target)"
                  v-if="!updating_social"
                >
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input
                          type="text"
                          name="name"
                          v-model="social_name"
                          class="form-control"
                          placeholder="Name"
                          required="required"
                          data-error="Name is required."
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input
                          type="text"
                          name="link"
                          v-model="social_link"
                          class="form-control"
                          placeholder="Link"
                          required="required"
                          data-error="Link is required."
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input
                          type="text"
                          name="icon"
                          v-model="social_icon"
                          class="form-control"
                          placeholder="Icon"
                          required="required"
                          data-error="Icon is required."
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Status</label>

                        <select name="status" class="form-control" v-model="status">
                          <option selected disabled>Select Status</option>

                          <option value="0">Disable</option>
                          <option value="1">Active</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Add</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <!-- Edit social modal -->
        <div class="modal fade" id="modal-editsocial">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Edit social</h4>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>

              <div class="modal-body">
                <sva-loader v-if="updating_social"></sva-loader>
                <form
                  method="post"
                  @submit.prevent="edit_social($event.target)"
                  v-if="!updating_social"
                >
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input
                          type="text"
                          name="name"
                          v-model="editsocial.name"
                          class="form-control"
                          placeholder="Name"
                          required="required"
                          data-error="Name is required."
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <input
                          type="text"
                          name="link"
                          v-model="editsocial.link"
                          class="form-control"
                          placeholder="Link"
                          required="required"
                          data-error="Link is required."
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <input
                          type="text"
                          name="icon"
                          class="form-control"
                          v-model="editsocial.icon"
                          required="required"
                          placeholder="Icon"
                          data-error="Icon is required."
                        />
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Status</label>

                        <select name="status" class="form-control" v-model="editsocial.status">
                          <option selected disabled>Select Status</option>

                          <option value="0">Disable</option>
                          <option value="1">Active</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Edit</button>
                  </div>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- Edit social modal end -->
        <sva-loader v-if="loading_transactions"></sva-loader>
        <div class="table-responsive-sm">
          <table class="table" v-if="!loading_transactions">
            <thead>
              <tr>
                <th scope="col">S/No</th>
                <th scope="col">Name</th>
                <th scope="col">Link</th>
                <th scope="col">Icon</th>
                <th scope="col">Status</th>
                <th scope="col">Date Created</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="(social, index) in socials" :key="index" class="lighter-text">
                <td>{{index +1}}</td>
                <td>{{social.name}}</td>
                <td>{{social.link}}</td>
                <td>{{social.icon}}</td>
                <td>
                  <span v-if="social.status == 0" class="text-info">Disabled</span>
                  <span v-if="social.status == 1" class="text-success">Active</span>
                </td>

                <td>{{format_date(social.created_at)}}</td>

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
                      <button
                        class="dropdown-item text-success noHover"
                        data-toggle="modal"
                        data-target="#modal-editsocial"
                        @click="set_editsocial(index)"
                      >
                        <i class="fa fa-edit"></i> Edit
                      </button>

                      <button
                        class="dropdown-item text-danger noHover"
                        @click="delete_social(social.id)"
                        type="submit"
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

import svaLoader from "../../components/loader.vue";
import svaBarcode from "../../components/barcode.vue";
import svaAlert from "../../components/alert.vue";

export default {
  name: "social-page",
  data() {
    return {
      error_message: "",
      data_returned: {},
      social_name: "",
      social_link: "",
      status: 1,
      socials: {},
      loading_transactions: true,
      editsocial: {},
      updating_social: false,
      social_icon: "",
      message: [],
      message_type: ""
    };
  },
  methods: {
    get_socials() {
      const REQUEST_URL = "/socials/";
      axios
        .get(REQUEST_URL)
        .then(response => {
          this.socials = response.data.social_details;
          this.loading_transactions = false;
        })
        .catch(error => {
          console.log("error");
        });
    },
    set_editsocial(index) {
      this.editsocial = this.socials[index];
    },

    update_transactions(data) {
      this.socials = data.social_details;
      this.loading_transactions = false;
    },

    delete_social(id) {
      if (confirm("Are you sure you want to delete?")) {
        const REQUEST_URL = "/delete-socials";
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
          this.get_socials();
        });
      }
    },

    add_social(form) {
      this.updating_social = true;

      if (confirm("Add social?")) {
        const REQUEST_URL = "/add-socials";
        let formdata = new FormData(form);
        axios({
          url: REQUEST_URL,
          method: "POST",
          data: formdata,
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
          }
        }).then(response => {
          if (parseInt(response.data.status) === 401) {
            this.updating_social = false;
            return this.display_error(response.data.message);
          }
          this.updating_social = false;
          $("#modal-default").modal("hide");
          this.get_socials();
        });
      }
    },
    edit_social(form) {
      this.updating_social = true;

      if (confirm("Edit social?")) {
        const REQUEST_URL = "/edit-socials";
        let formdata = new FormData(form);
        formdata.append("id", this.editsocial.id);
        axios({
          url: REQUEST_URL,
          method: "POST",
          data: formdata,
          headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
          }
        }).then(response => {
          if (parseInt(response.data.status) === 401) {
            this.updating_social = false;
            return this.display_error(response.data.message);
          }
          this.updating_social = false;
          $("#modal-editsocial").modal("hide");
          this.get_socials();
        });
      }
    },
    display_error(error_message) {
      this.message = [];
      Object.keys(error_message).forEach(error => {
        let message = error_message[error];
        this.message_type = "danger";
        message.forEach(mes => {
          this.message.push(mes);
        });
      });
    }
  },
  watch: {
    message() {
      const hideMessage = () => {
        this.message = [];
      };
      if (this.message.length > 0) {
        setTimeout(function() {
          hideMessage();
        }, 5000);
      }
    }
  },
  mixins: [formatMixin],
  mounted() {
    this.get_socials();
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
  border-radius: 10px;
  margin-top: 5rem;
  td {
    color: inherit;
    white-space: nowrap;
  }
  th {
    color: unset;
  }
  .transaction-table-title {
    color: hsl(130, 6%, 40%);
  }
}
</style>
