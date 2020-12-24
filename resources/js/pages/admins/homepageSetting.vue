<template>
  <div class="homepage-homepage">
    <h3 class="page-title light-text">Homepage Settings</h3>
    <sva-loader v-if="updating_homepage"></sva-loader>
    <div class="mt-5">
      <div
        class="col-md-7 col-sm-8 m-auto p-5 lighter-text dark-bg--lighter"
        v-if="!updating_homepage"
      >
        <form method="post" @submit.prevent="update_homepage($event.target)">
          <div class="form-group">
            <label>Home Page title</label>
            <textarea
              type="text"
              name="title"
              rows="5"
              v-model="homepage.title"
              class="form-control"
              placeholder="Enter Home Page Title"
            ></textarea>
          </div>
          <div class="form-group">
            <label>Homepage Description</label>
            <textarea
              class="form-control"
              rows="5"
              name="description"
              v-model="homepage.description"
            ></textarea>
          </div>

          <div class="form-group">
            <img class="img-center" :src="homepage.photo" width="40" height="40" alt />
            <label>Homepage Image</label>
            <input type="file" name="photo" class="form-control" />
          </div>

          <div class="form-group">
            <img class="img-center" :src="homepage.about_us_photo" width="40" height="40" alt />
            <label>Homepage About US Image</label>
            <input type="file" name="about_us_photo" class="form-control" />
          </div>

          <div class="form-group">
            <label>Homepage Video Text</label>
            <textarea
              type="text"
              rows="5"
              name="video_text"
              v-model="homepage.video_text"
              class="form-control"
              placeholder="Video Text on Homepage"
            ></textarea>
          </div>

          <div class="form-group">
            <label>Homepage Get Started Text</label>
            <textarea
              type="text"
              rows="5"
              name="get_start_text"
              v-model="homepage.get_start_text"
              class="form-control"
              placeholder="Enter Homepage Get Started"
            ></textarea>
          </div>

          <div class="form-group">
            <img class="img-center" :src="homepage.get_start_text_image" width="40" height="40" alt />
            <label>Homepage Get Start Image</label>
            <input type="file" name="get_start_text_image" class="form-control" />
          </div>
          <div class="form-group">
            <label>Homepage Why Us Text</label>
            <textarea
              type="text"
              rows="5"
              name="why_us_text"
              v-model="homepage.why_us_text"
              class="form-control"
              placeholder="why us text"
            ></textarea>
          </div>
          <div class="form-group">
            <label>Homepage Benefit Text</label>
            <textarea
              type="text"
              rows="5"
              name="benefit_text"
              v-model="homepage.benefit_text"
              class="form-control"
              placeholder="Benefit text"
            ></textarea>
          </div>
          <div class="form-group">
            <label>Homepage Benefit Section Text</label>
            <textarea
              type="text"
              rows="5"
              name="get_beneift_text"
              v-model="homepage.get_beneift_text"
              class="form-control"
              placeholder="Benefit text Section Text"
            ></textarea>
          </div>

          <div class="form-group">
            <img class="img-center" :src="homepage.why_us_text_image" width="40" height="40" alt />
            <label>Homepage Why Us Image</label>
            <input type="file" name="why_us_text_image" class="form-control" />
          </div>

          <div class="modal-footer justify-content-between">
            <button type="submit" class="btn btn-success">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
import moment from "moment";

import formatMixin from "../../mixins/formattingMixin";

import svaLoader from "../../components/loader.vue";
import svaBarcode from "../../components/barcode.vue";
import svaAlert from "../../components/alert.vue";

export default {
  name: "homepage-page",
  data() {
    return {
      homepage: [],
      updating_homepage: false
    };
  },
  methods: {
    get_homepages() {
      const REQUEST_URL = "/homepage/";
      axios
        .get(REQUEST_URL)
        .then(response => {
          this.homepage = response.data.homepages;
          this.updating_homepage = false;
        })
        .catch(error => {
          console.log("error");
        });
    },

    update_transactions(data) {
      this.homepage = data.homepages;
      this.loading_transactions = false;
    },
    update_homepage(form) {
      this.updating_homepage = true;
      const formdata = new FormData(form);
      axios({
        url: "/homepage",
        method: "post",
        data: formdata,
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
      }).then(() => {
        this.get_homepages();
      });
    }
  },

  mixins: [formatMixin],
  mounted() {
    this.get_homepages();
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
