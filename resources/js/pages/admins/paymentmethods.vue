<template>
  <div class="manage-plans">
    <h3 class="page-title lighter-text">Payment Methods</h3>
    <div class="list-table dark-bg--lighter p-5 table-responsive mt-5">
      <div
        class="modal fade"
        id="exampleModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit {{address_editing.name}}</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="editform">
                <div v-if="message.length > 0">
                  <sva-alert
                    v-for="(mes, index) in message"
                    :key="index"
                    :message="mes"
                    :type="message_type"
                  ></sva-alert>
                </div>
                <form method="post" @submit.prevent="update_address($event.target)">
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input
                      type="text"
                      v-model="address_editing.address"
                      name="address"
                      id="address"
                      class="form-control"
                    />
                  </div>
                  <div class="form-group">
                    <label for="api_key">Api Key</label>
                    <input
                      type="text"
                      v-model="address_editing.api_key"
                      name="api_key"
                      id="api_key"
                      class="form-control"
                    />
                  </div>
                  <div class="form-group">
                    <label for="status">Status</label>
                    <select
                      name="status"
                      id="status"
                      v-model="address_editing.status"
                      class="custom-select"
                    >
                      <option value="1">Enabled</option>
                      <option value="0">Disabled</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="coin-image">Coin Image</label>
                    <input type="file" class="form-control" name="photo" />
                  </div>
                  <div class="form-group mt-4">
                    <button class="btn btn-primary">Save changes</button>
                  </div>
                </form>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <table class="table table-striped">
        <thead>
          <tr>
            <th>Name</th>
            <th>Address</th>
            <th>API Key</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(coin, index) in coins" :key="index" class="light-text">
            <td class="text-color">{{coin.name}}</td>
            <td class="text-color">{{coin.address}}</td>
            <td class="text-color">{{coin.api_key}}</td>
            <td>
              <span v-if="coin.status == 1" class="bg-success coin-status text-light">Enabled</span>
              <span v-if="coin.status == 0" class="bg-danger coin-status text-light">Disabled</span>
            </td>
            <td>
              <img :src="coin.photo" width="150px" class="img-fluid" alt="coin image" />
            </td>
            <td>
              <i
                class="fa fa-ellipsis-h table-menu-btn text-color"
                @click="display_table_menu()"
                role="button"
              ></i>
              <div class="table-actions d-none">
                <div class="action-list rounded-lg border white-bg p-4">
                  <ul class="list-unstyled">
                    <li class="mb-3">
                      <button
                        class="btn text-color p-0"
                        type="button"
                        data-toggle="modal"
                        data-target="#exampleModal"
                        @click="edit_address(index)"
                      >Edit</button>
                    </li>
                  </ul>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import messageMixin from "../../mixins/messageMixin";
export default {
  name: "coinsettings-page",
  data() {
    return {
      coins: [],
      coin_info: {},
      address_editing: {}
    };
  },
  methods: {
    get_coin_settings() {
      const REQUEST_URL = "/coin-setting";
      axios.get(REQUEST_URL).then(response => {
        this.coin_info = response.data;
        this.coins = this.coin_info.coins.data;
      });
    },
    display_table_menu() {
      const MENU_ELEM = event.target;
      const ELEM = MENU_ELEM.nextElementSibling;
      if (ELEM.classList.contains("d-none")) {
        return ELEM.classList.remove("d-none");
      }
      return ELEM.classList.add("d-none");
    },
    edit_address(index) {
      this.address_editing = this.coins[index];
    },
    update_address(form) {
      this.message = [];
      this.message_type = "info";
      this.message.push("Updating ...");
      const REQUEST_URL = "/edit-coin";
      const formdata = new FormData(form);
      formdata.append("id", this.address_editing.id);
      formdata.append("name", this.address_editing.name);
      axios({
        url: REQUEST_URL,
        method: "post",
        data: formdata,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
      })
        .then(() => {
          this.message = [];
          this.message_type = "success";
          this.message.push("Address Succesfully updated");
          this.get_coin_settings();
          $("#exampleModal").modal("hide");
        })
        .catch(() => {
          this.message = [];
          this.message_type = "danger";
          this.message.push("Cannot update this address");
        });
    }
  },
  created() {
    this.get_coin_settings();
  },
  mixins: [messageMixin]
};
</script>

<style lang="scss" scoped>
.coin-status {
  font-size: 0.8rem;
  border-radius: 30px;
  padding: 0.2rem 0.6rem;
}
td {
  color: inherit;
}
.list-table {
  border-radius: 20px;
}
</style>
