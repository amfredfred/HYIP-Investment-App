<template>
  <div class="manage-plans">
    <h3 class="page-title lighter-text">Manage Plans</h3>
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
            <h5 class="modal-title" id="exampleModalLabel">Edit Plan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div>
              <form method="post" @submit.prevent="update_plan($event.target)">
                <div v-if="message.length > 0 && editing_plan" class="mb-4">
                  <sva-alert
                    v-for="(mes, index) in message"
                    :key="index"
                    :message="mes"
                    :type="message_type"
                  ></sva-alert>
                </div>
                <div class="form-group mb-5">
                  <label for="planname" class="text-color">Plan Name</label>
                  <input
                    type="text"
                    id="planname"
                    class="form-control"
                    v-model="plan_in_edit.name"
                    name="name"
                  />
                </div>
                <div class="form-group mb-5">
                  <label for="planinterest" class="text-color">Plan Interest</label>
                  <input
                    type="number"
                    id="planinterest"
                    class="form-control"
                    name="percentage"
                    placeholder="e.g 10 for 10%"
                    v-model="plan_in_edit.percentage"
                  />
                </div>
                <div class="form-group mb-5">
                  <label for="plan-compound" class="text-color">Select Compound</label>
                  <select
                    name="compound_id"
                    id="plan-compound"
                    class="custom-select"
                    v-model="plan_in_edit.compound_id"
                  >
                    <option value>Select Compound</option>
                    <option
                      :value="compound.id"
                      v-for="(compound, index) in compounds"
                      :key="index"
                      v-text="compound.name"
                    ></option>
                  </select>
                </div>
                <div class="form-group mb-5">
                  <label for="ref-bonus" class="text-color">Referral Bonus</label>
                  <input
                    type="number"
                    id="ref-bonus"
                    class="form-control"
                    name="ref"
                    placeholder="e.g 2 for 2%"
                    v-model="plan_in_edit.ref"
                  />
                </div>
                <div class="form-group mb-5">
                  <label for="min-deposit" class="text-color">Minimum deposit</label>
                  <input
                    type="number"
                    id="min-deposit"
                    class="form-control"
                    name="min"
                    placeholder="e.g 300 for $300"
                    v-model="plan_in_edit.min"
                  />
                </div>
                <div class="form-group mb-5">
                  <label for="max-deposit" class="text-color">Maxmum deposit</label>
                  <input
                    type="number"
                    id="max-deposit"
                    class="form-control"
                    name="max"
                    placeholder="e.g 300 for $300"
                    v-model="plan_in_edit.max"
                  />
                </div>
                <div class="form-group mb-5">
                  <label for="deposit_fee" class="text-color">Deposit fee</label>
                  <input
                    type="number"
                    id="deposit_fee"
                    class="form-control"
                    name="deposit_fee"
                    placeholder="e.g 300 for $300"
                    v-model="plan_in_edit.deposit_fee"
                  />
                </div>
                <div class="form-group">
                  <button class="btn btn-success">Save Changes</button>
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
    <div class="create-plan dark-bg--lighter p-5 col-md-7 col-sm-9 m-auto">
      <div class="row justify-content-between">
        <h6 class="title light-text mb-5">New Plan</h6>
        <button
          class="toggle-create-form btn btn-secondary"
          role="button"
          aria-labelledby="toggle plan creation form"
          :title="show_create_form ? 'collapse': 'Show form'"
          @click="show_create_form = !show_create_form"
        >Add new Plan</button>
      </div>
      <form method="post" v-show="show_create_form" @submit.prevent="create_plan($event.target)">
        <div v-if="message.length > 0 && !editing_plan" class="mb-4">
          <sva-alert
            v-for="(mes, index) in message"
            :key="index"
            :message="mes"
            :type="message_type"
          ></sva-alert>
        </div>
        <div class="form-group mb-5">
          <label for="planname" class="light-text">Plan Name</label>
          <input type="text" id="planname" class="form-control" name="name" />
        </div>
        <div class="form-group mb-5">
          <label for="planinterest" class="light-text">Plan Interest</label>
          <input
            type="number"
            id="planinterest"
            class="form-control"
            name="percentage"
            placeholder="e.g 10 for 10%"
          />
        </div>
        <div class="form-group mb-5">
          <label for="plan-compound" class="light-text">Select Compound</label>
          <select name="compound_id" id="plan-compound" class="custom-select">
            <option value>Select Compound</option>
            <option
              :value="compound.id"
              v-for="(compound, index) in compounds"
              :key="index"
              v-text="compound.name"
            ></option>
          </select>
        </div>
        <div class="form-group mb-5">
          <label for="ref-bonus" class="light-text">Referral Bonus</label>
          <input
            type="number"
            id="ref-bonus"
            class="form-control"
            name="ref"
            placeholder="e.g 2 for 2%"
          />
        </div>
        <div class="form-group mb-5">
          <label for="min-deposit" class="light-text">Minimum deposit</label>
          <input
            type="number"
            id="min-deposit"
            class="form-control"
            name="min"
            placeholder="e.g 300 for $300"
          />
        </div>
        <div class="form-group mb-5">
          <label for="max-deposit" class="light-text">Maxmum deposit</label>
          <input
            type="number"
            id="max-deposit"
            class="form-control"
            name="max"
            placeholder="e.g 300 for $300"
          />
        </div>
        <div class="form-group mb-5">
          <label for="deposit_fee" class="light-text">Deposit fee</label>
          <input
            type="number"
            id="deposit_fee"
            class="form-control"
            name="deposit_fee"
            placeholder="e.g 300 for $300"
          />
        </div>
        <div class="form-group">
          <button class="btn btn-success">Create Plan</button>
        </div>
      </form>
    </div>

    <div class="transaction-table dark-bg--lighter p-5">
      <h4 class="transaction-table-title lighter-text my-4">Plans</h4>
      <sva-loader v-if="loading_plansettings"></sva-loader>
      <div class="table-responsive p-4">
        <table class="table" v-if="!loading_plansettings">
          <thead>
            <tr class="lighter-text">
              <th scope="col">Date</th>
              <th scope="col">Plan Name</th>
              <th scope="col">Min. deposit</th>
              <th scope="col">Max. Deposit</th>
              <th scope="col">Interest</th>
              <th scope="col">Compound</th>
              <th scope="col">Referral Bonus</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(plan, index) in plans" :key="index" class="light-text">
              <td>{{format_date(plan.created_at)}}</td>
              <td>{{plan.name}}</td>
              <td>{{format_currency(plan.min)}}</td>
              <td>{{format_currency(plan.max)}}</td>
              <td>{{plan.percentage}}%</td>
              <td>{{plan.compound.name}}</td>
              <td>{{plan.ref}}%</td>
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
                          @click="set_editing_plan(index)"
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
  </div>
</template>

<script>
import formatMixin from "../../mixins/formattingMixin";
import messageMixin from "../../mixins/messageMixin";

import svaLoader from "../../components/loader.vue";
export default {
  name: "manage-plans",
  data() {
    return {
      plans_settings: {},
      compounds: [],
      plans: {},
      loading_plansettings: false,
      show_create_form: false,

      editing_plan: false,
      plan_in_edit: {}
    };
  },
  methods: {
    get_plan_setings() {
      this.loading_plansettings = true;
      const REQUEST_URL = "/plan-setting";
      axios
        .get(REQUEST_URL)
        .then(response => {
          this.plans = response.data.plans;
          this.compounds = response.data.compounds;
          this.plans_settings = response.data;
          this.loading_plansettings = false;
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
    create_plan(form) {
      this.message = [];
      this.message_type = "info";
      this.message.push("creating ...");
      const REQUEST_URL = "/add-plan";
      const formdata = new FormData(form);

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
          this.message.push("Plan created successfully");
          form.reset();
          return this.get_plan_setings();
        })
        .catch(() => {
          this.message = [];
          this.message_type = "danger";
          this.message.push("Unable to create plan");
        });
    },
    set_editing_plan(index) {
      this.editing_plan = true;
      this.plan_in_edit = this.plans[index];
    },
    update_plan(form) {
      this.message = [];
      this.message_type = "info";
      this.message.push("saving ...");
      const REQUEST_URL = "/edit-plan";
      const formdata = new FormData(form);
      formdata.append("id", this.plan_in_edit.id);

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
          this.message.push("Plan saved successfully");
          form.reset();
          this.editing_plan = false;
          $("#exampleModal").modal("hide");
          return this.get_plan_setings();
        })
        .catch(() => {
          this.message = [];
          this.message_type = "danger";
          this.message.push("Unable to update plan");
        });
    }
  },
  created() {
    this.get_plan_setings();
  },
  mixins: [formatMixin, messageMixin],
  components: { svaLoader }
};
</script>

<style lang="scss" scoped>
.create-plan {
  border-radius: 20px;
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