<template>
  <div class="mailsystem">
    <h3 class="page-title lighter-text">Mail Sender</h3>

    <div class="mt-5">
      <div class="col-md-7 col-sm-8 m-auto p-4 dark-bg--lighter lighter-text">
        <div v-if="message.length > 0">
          <sva-alert
            v-for="(mes, index) in message"
            :key="index"
            :message="mes"
            :type="message_type"
          ></sva-alert>
        </div>
        <form method="post" @submit.prevent="sendmail($event.target)">
          <div class="form-group">
            <select
              name="users[]"
              class="selectpicker form-control"
              multiple
              data-live-search="true" id="users"
            >
              <option disabled>Select User</option>
              <option v-for="user in users" :key="user.id" :value="user.id">
                {{ user.first_name }} {{ user.last_name }}
              </option>
            </select>
          </div>
          <div class="form-group">
            <label for="title" class="lighter-text">Email Title</label>
            <input type="text" name="title" class="form-control" id="title" />
          </div>
          <div class="form-group">
            <label for="message" class="lighter-text">Message</label>
            <textarea
              name="message"
              id="message"
              class="form-control"
              rows="6"
            ></textarea>
          </div>
          <div class="form-group">
            <button class="btn btn-success">Send Message</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import svaAlert from "../../components/alert.vue";
export default {
  name: "mailsystem",
  data() {
    return {
      message: [],
      message_type: "",
      users: {},
    };
  },
  methods: {
    get_users() {
      const REQUEST_URL = "/users-mail/";
      axios
        .get(REQUEST_URL)
        .then((response) => {
          this.users = response.data.user_details;
        })
        .catch((error) => {
          console.log("error");
        });
    },
    sendmail(form) {
      this.message_type = "info";
      this.message.push("Sending Message ...");
      const formdata = new FormData(form);
      const REQUEST_URL = "mailing";

      axios({
        url: REQUEST_URL,
        method: "post",
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
          this.message.push("Message Sent");
        })
        .catch(() => {
          this.message = [];
          this.message_type = "danger";
          this.message.push("Cannot send emails");
        });
    },
    display_error(error_message) {
      this.message = [];
      Object.keys(error_message).forEach((error) => {
        let message = error_message[error];
        this.message_type = "danger";
        message.forEach((mes) => {
          this.message.push(mes);
        });
      });
    },
  },
  watch: {
    message() {
      const hideMessage = () => {
        this.message = [];
      };
      if (this.message.length > 0) {
        setTimeout(function () {
          hideMessage();
        }, 5000);
      }
    },
  },
  updated: function(){
  this.$nextTick(function(){ $('.selectpicker').selectpicker('refresh'); });
},
  mounted() {
    this.get_users();
  },
  components: { svaAlert },
};
</script>

<style>
</style>