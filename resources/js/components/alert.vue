<template>
  <div class="sva-alert">
    <div class="alert" :class="['alert-'+type]" role="alert">{{message}}</div>
  </div>
</template>

<script>
export default {
  name: "sva-alert",
  props: {
    message: String,
    type: String
  }
};
</script>

<style>
</style>