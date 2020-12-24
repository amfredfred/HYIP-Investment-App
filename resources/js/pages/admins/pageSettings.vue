<template>
  <div class="page-settings">
    <h3 class="page-title light-text">Manage Pages</h3>

    <div class="create-page dark-bg--lighter p-5 col-md-8 col-sm- m-auto">
      <div class="row justify-content-between">
        <h6 class="title mb-5 light-text">New Page</h6>
        <button
          class="toggle-create-form btn btn-secondary"
          role="button"
          aria-labelledby="toggle plan creation form"
          :title="show_create_form ? 'collapse': 'Show form'"
          @click="show_create_form = !show_create_form"
        >Add new Page</button>
      </div>
      <form method="post" v-show="show_create_form" @submit.prevent="save_changes($event.target)">
        <div v-if="message.length > 0" class="mb-4">
          <sva-alert
            v-for="(mes, index) in message"
            :key="index"
            :message="mes"
            :type="message_type"
          ></sva-alert>
        </div>
        <div class="form-group mb-5">
          <label for="pagename" class="light-text">Page Name</label>
          <input
            type="text"
            v-model="page_in_edit.title"
            id="pagename"
            class="form-control"
            name="title"
          />
        </div>

        <div class="form-group mb-5">
          <label for="description" class="light-text">Page Description</label>
          <div class="form-control description-editor" id="description-editor"></div>
        </div>
        <div class="form-group mb-5">
          <label for="col1" class="light-text">Column 1 (optional)</label>
          <textarea name="col1" id="col1" v-model="page_in_edit.col1" class="form-control" rows="5"></textarea>
        </div>

        <div class="form-group mb-5">
          <label for="col2" class="light-text">Column 2 (optional)</label>
          <textarea name="col2" id="col2" class="form-control" v-model="page_in_edit.col2" rows="5"></textarea>
        </div>
        <div class="form-group mb-5">
          <label for="col3" class="light-text">Column 3 (optional)</label>
          <textarea v-model="page_in_edit.col3" name="col3" id="col3" class="form-control" rows="5"></textarea>
        </div>

        <div class="form-group mb-5">
          <label for="slug" class="light-text">Slug</label>
          <input type="text" name="slug" v-model="page_in_edit.slug" class="form-control" id="slug" />
        </div>

        <div class="form-group">
          <button class="btn btn-success">Create Page</button>
        </div>
      </form>
    </div>

    <div class="transaction-table dark-bg--lighter p-5">
      <h4 class="transaction-table-title my-4 text-light">Pages</h4>
      <sva-loader v-if="loading_pages"></sva-loader>
      <div class="table-responsive p-4">
        <table class="table" v-if="!loading_pages">
          <thead>
            <tr class="light-text">
              <th scope="col">Page Name</th>
              <th scope="col">Slug</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(page, index) in pages" :key="index" class="light-text">
              <td>{{page.title}}</td>
              <td>{{page.slug}}</td>
              <td>
                <i
                  class="fa fa-ellipsis-h table-menu-btn light-text"
                  @click="display_table_menu()"
                  role="button"
                ></i>
                <div class="table-actions d-none">
                  <div class="action-list rounded-lg border white-bg p-4">
                    <ul class="list-unstyled">
                      <li class="mb-3">
                        <button
                          class="btn light-text p-0"
                          type="button"
                          @click="set_editing_page(index)"
                        >Edit</button>
                      </li>
                      <li class="mb-3">
                        <button
                          class="btn light-text p-0"
                          type="button"
                          @click="delete_page(page.id)"
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
  </div>
</template>

<script>
import formatMixin from "../../mixins/formattingMixin";
import messageMixin from "../../mixins/messageMixin";

import svaLoader from "../../components/loader.vue";
export default {
  name: "manage-pages",
  data() {
    return {
      pages: [],
      loading_pages: false,
      show_create_form: false,

      quill: null,

      editing_page: false,
      page_in_edit: {
        title: "",
        col1: "",
        col2: "",
        col3: "",
        slug: ""
      }
    };
  },
  methods: {
    get_page_setings() {
      this.loading_pages = true;
      const REQUEST_URL = "/pages";
      axios
        .get(REQUEST_URL)
        .then(response => {
          this.pages = response.data.page_details;
          this.loading_pages = false;
        })
        .catch(error => {
          console.log("error");
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
    save_changes(form) {
      if (this.editing_page) {
        return this.update_page(form);
      }
      return this.create_page(form);
    },
    create_page(form) {
      this.message = [];
      this.message_type = "info";
      this.message.push("creating ...");
      const REQUEST_URL = "/add-page";
      const formdata = new FormData(form);
      formdata.append("description", this.quill.root.innerHTML);

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
          this.message.push("page created successfully");
          this.clearFormInput();
          return this.get_page_setings();
        })
        .catch(error => {
          console.log(error);
          this.message = [];
          this.message_type = "danger";
          this.message.push("Unable to create page");
        });
    },
    set_editing_page(index) {
      this.editing_page = true;
      this.page_in_edit = this.pages[index];
      (this.show_create_form = true),
        (this.quill.root.innerHTML = this.page_in_edit.description);
    },
    update_page(form) {
      this.message = [];
      this.message_type = "info";
      this.message.push("saving ...");
      const REQUEST_URL = "/edit-page";
      const formdata = new FormData(form);
      formdata.append("id", this.page_in_edit.id);
      formdata.append("description", this.quill.root.innerHTML);

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
          this.message.push("page saved successfully");
          this.clearFormInput();
          this.editing_page = false;
          return this.get_page_setings();
        })
        .catch(error => {
          console.log(error);
          this.message = [];
          this.message_type = "danger";
          this.message.push("Unable to update page");
        });
    },
    delete_page(id) {
      if (confirm("Are you sure you want to delete this page?")) {
        const REQUEST_URL = "/delete-page";
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
          this.get_page_setings();
        });
      }
    },
    mountQuil() {
      // Initialize the editor for descriptions
      const quill = new Quill("#description-editor", {
        theme: "snow"
      });
      this.quill = quill;
    },
    clearFormInput() {
      (this.page_in_edit.title = ""),
        (this.page_in_edit.col1 = ""),
        (this.page_in_edit.col2 = ""),
        (this.page_in_edit.col3 = ""),
        (this.page_in_edit.slug = ""),
        (this.quill.root.innerHTML = "");
      this.show_create_form = false;
    }
  },
  created() {
    this.get_page_setings();
  },
  mounted() {
    this.mountQuil();
  },
  mixins: [formatMixin, messageMixin],
  components: { svaLoader }
};
</script>

<style lang="scss" scoped>
.create-page {
  border-radius: 20px;
}
.transaction-table {
  border-radius: 10px;
  margin-top: 5rem;
  // td {
  //   color: hsl(130, 6%, 40%);
  //   white-space: nowrap;
  // }
  // th {
  //   color: hsl(130, 6%, 40%);
  // }
  .transaction-table-title {
    color: hsl(130, 6%, 40%);
  }
}
.toggle-create-form {
  font-size: 1.4rem;
  cursor: pointer;
}
.description-editor {
  height: 20rem;
}
td {
  color: inherit;
}
th {
  color: inherit;
}
</style>
