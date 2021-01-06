<template>
  <div class="barcode-image">
    <div class>
      <img :src="qr_image" width="200px" alt class="img-fluid" />
      <div class="light-text">Scan to pay</div>
    </div>
    <div class="payment-information mt-4">
      <h6>Payment information</h6>

      <ul class="list-unstyled p-0 mt-3 light-text">
        <li>
          <h6 class="wallet-type">{{coin_details.name}}</h6>
        </li>
        <li>
          <div class="row">
            <div class="coin-address lighter-text col-10">
              <p>{{coin_details.address}}</p>
            </div>
            <div class="col-2">
              <sva-copy :text="coin_details.address"></sva-copy>
            </div>
          </div>
        </li>
        <li>
          <div class="amount-paying">
            <h6 class="d-inline-block">Amount to pay -</h6>
            ${{invest_details.amount}}
          </div>
        </li>
        <!-- <li>
          <div class="amount-paying mt-2">
            <h6 class="d-inline-block">Deposit Fee -</h6>
            ${{invest_details.deposit_investment_charge}}
          </div>
        </li>-->
        <li>
          <div class="amount-paying mt-4">
            <h6 class="d-inline-block">Total -</h6>
            ${{invest_details.amount}}
          </div>
        </li>
        <li>
          <div class="mt-4 amount-paying">
            <h6 class="d-inline-block">{{full_data.name}} -</h6>
            {{full_data.amount_convert}}
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import svaCopy from "./copyClipboard.vue";
export default {
  name: "sva-barcode",
  data() {
    return {
      qr_image: null,
      coin_details: {},
      invest_details: {},
      full_data: {},
    };
  },
  methods: {
    mount_data(data) {
      this.qr_image = data.image_qrcode;
      this.coin_details = data.coin;
      (this.invest_details = data.invest), (this.full_data = data);
    },
  },
  mounted() {
    this.mount_data(this.data);
  },
  computed: {
    totalPrice() {
      return (
        parseFloat(this.invest_details.deposit_investment_charge) +
        parseFloat(this.invest_details.amount)
      );
    },
  },
  props: ["data"],
  components: { svaCopy },
};
</script>

<style lang="scss" scoped>
.payment-information {
  word-break: break-all;

  .coin-address {
    color: inherit;
  }
  .wallet-type,
  .amount-paying,
  h6 {
    color: inherit;
  }
}
</style>
