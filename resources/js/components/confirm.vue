<template>
  <transition
    enter-active-class="animate__animated animate__zoomIn"
    leave-active-class="animate__animated animate__zoomOut"
    class
  >
    <div class="sva-confirm col-11 col-md-5 col-sm-9 shadow p-5">
      <div class="message text-center">
        <p>
          <slot></slot>
        </p>
      </div>
      <div class="text-center mt-5">
        <button class="btn btn-confirm mr-3" @click="confirm()">CONFIRM</button>
        <button class="btn btn-cancel" @click="cancel()">CANCEL</button>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  name: "sva-confirm",
  methods: {
    confirm() {
      return this.$emit("confirmation", true);
    },
    cancel() {
      return this.$emit("confirmation", false);
    }
  }
};
</script>

<style lang="scss" scoped>
.sva-confirm {
  position: fixed;
  top: 20%;
  @media screen and (min-width: 576px) {
    left: 20%;
  }
  @media screen and (min-width: 768px) {
    left: 30%;
  }
  z-index: 1;
  background-color: #f7f8f6;
  border-radius: 20px;
  .message {
    color: hsl(240, 3%, 45%);
  }
  .btn-confirm {
    color: #3955d1;
  }
  .btn-cancel {
    color: hsl(240, 3%, 45%);
  }
}
</style>