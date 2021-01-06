<template >
  <div>
    <h3>Fund</h3>
    <v-row>
      <v-col cols="12" sm="6">
        <v-card class="p-3">
          <sva-barcode :data="fundDetails"></sva-barcode>
        </v-card>
      </v-col>
      <v-col cols="12" sm="6">
        <sva-confirm :transaction_id="fundDetails.invest.transaction_id"></sva-confirm>
      </v-col>
    </v-row>
  </div>
</template>
  <script>
import { mapGetters } from "vuex";
import svaBarcode from "../../../components/barcode";
import svaConfirm from "../../../components/confirmDeposit";

export default {
  name: "fund-account",
  components: { svaBarcode, svaConfirm },
  computed: {
    ...mapGetters("user", ["fundDetails"]),
  },
};
</script>
