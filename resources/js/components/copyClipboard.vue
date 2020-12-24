<template>
  <div>
    <button
      class="btn"
      :class="{'copy-success': copied}"
      v-clipboard:copy="text"
      v-clipboard:success="isCopied"
    >
      <i class="fa fa-copy text-muted"></i>
    </button>
  </div>
</template>

<script>
export default {
  name: "sva-copy",
  data() {
    return {
      copied: false
    };
  },
  methods: {
    isCopied() {
      this.copied = true;
    }
  },
  props: ["text"]
};
</script>

<style lang="scss" scoped>
.copy-success {
  background-color: rgb(195, 228, 195);
  color: rgb(29, 71, 29);
}
</style>