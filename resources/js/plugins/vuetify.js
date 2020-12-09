import Vue from "vue";
import Vuetify, { VApp, VMain } from "vuetify/lib";
import "vuetify/dist/vuetify.min.css";

Vue.use(Vuetify, { components: { VApp, VMain } });

const opts = {};

export default new Vuetify(opts);
