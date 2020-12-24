<template>
  <div class="manage-plans">
    <h3 class="page-title lighter-text">Manage Compounds</h3>

    <div class="list-table dark-bg--lighter p-5 table-responsive mt-5">
      <button
        class="btn btn-info mb-4"
        type="button"
        data-toggle="modal"
        data-target="#createCompoundModal"
      >create new compound</button>
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
              <h5 class="modal-title" id="exampleModalLabel">Edit Compound</h5>
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
                <form method="post" @submit.prevent="update_compound($event.target)">
                  <div class="form-group">
                    <label for="edit-name">name</label>
                    <input
                      type="text"
                      v-model="compound_editing.name"
                      name="name"
                      id="edit-name"
                      class="form-control"
                    />
                  </div>
                  <div class="form-group">
                    <label for="edit-compound">Compound</label>
                    <input
                      type="text"
                      v-model="compound_editing.compound"
                      name="compound"
                      id="edit-compound"
                      class="form-control"
                    />
                  </div>
                  <div class="form-group">
                    <label for="edit-compound">Compound Turn Over</label>
                    <input
                      type="text"
                      v-model="compound_editing.compound_turn_over"
                      name="compound_turn_over"
                      class="form-control"
                    />
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
      <div
        class="modal fade"
        id="createCompoundModal"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Create Compound</h5>
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
                <form method="post" @submit.prevent="create_compound($event.target)">
                  <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" name="name" id="name" class="form-control" />
                  </div>
                  <div class="form-group">
                    <label for="compound">Compound</label>
                    <input
                      type="text"
                      name="compound"
                      id="compound"
                      class="form-control"
                      placeholder="must be in hours"
                    />
                  </div>
                  <div class="form-group">
                    <label for="turn">Compound Turn Over</label>
                    <input type="text" name="compound_turn_over" class="form-control" />
                  </div>

                  <div class="form-group mt-4">
                    <button class="btn btn-primary">Save Compound</button>
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
            <th>Compound</th>
            <th>Compound Turn Over</th>
            <th>Created</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(compound, index) in compounds" :key="index" class="lighter-text">
            <td class="text-color">{{compound.name}}</td>
            <td class="text-color">{{compound.compound}}</td>
            <td class="text-color">{{compound.compound_turn_over}}</td>
            <td class="text-color">{{format_date(compound.created_at)}}</td>

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
                        @click="edit_compound(index)"
                      >Edit</button>
                    </li>
                    <li class="mb-3">
                      <button
                        class="btn text-color p-0"
                        type="button"
                        @click="delete_compound(compound.id)"
                      >Delete</button>
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
import formatMixin from "../../mixins/formattingMixin";

export default {
  name: "compoundsettings-page",
  data() {
    return {
      compounds: [],
      compound_info: {},
      compound_editing: {}
    };
  },
  methods: {
    get_compounds() {
      const REQUEST_URL = "/compound-setting";
      axios.get(REQUEST_URL).then(response => {
        this.compound_info = response.data;
        this.compounds = this.compound_info.compounds;
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
    edit_compound(index) {
      this.compound_editing = this.compounds[index];
    },
    create_compound(form) {
      this.message = [];
      this.message_type = "info";
      this.message.push("Creating ...");
      const REQUEST_URL = "/add-compound";
      const formdata = new FormData(form);
      formdata.append("id", this.compound_editing.id);
      axios({
        url: REQUEST_URL,
        method: "post",
        data: formdata,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
      })
        .then(response => {
          if (parseInt(response.data.status) === 401) {
            return this.display_error(response.data.message);
          }
          this.message = [];
          this.message_type = "success";
          this.message.push("Compound succesfully created");
          this.get_compounds();
          $("#createCompoundModal").modal("hide");
        })
        .catch(() => {
          this.message = [];
          this.message_type = "danger";
          this.message.push("Cannot create this compound");
        });
    },
    update_compound(form) {
      this.message = [];
      this.message_type = "info";
      this.message.push("Updating ...");
      const REQUEST_URL = "/edit-compound";
      const formdata = new FormData(form);
      formdata.append("id", this.compound_editing.id);
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
          this.message.push("compound Succesfully updated");
          this.get_compounds();
          $("#exampleModal").modal("hide");
        })
        .catch(() => {
          this.message = [];
          this.message_type = "danger";
          this.message.push("Cannot update this compound");
        });
    },
    delete_compound(id) {
      if (confirm("Are you sure you want to delete this coumpound?")) {
        const REQUEST_URL = "/delete-compound";
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
          this.get_compounds();
        });
      }
    }
  },
  created() {
    this.get_compounds();
  },
  mixins: [messageMixin, formatMixin]
};
</script>

<style lang="scss" scoped>
.coin-status {
  font-size: 0.8rem;
  border-radius: 30px;
  padding: 0.2rem 0.6rem;
}
.list-table {
  border-radius: 20px;
}
td {
  color: inherit;
}
</style>
