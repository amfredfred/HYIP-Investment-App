<template>
  <div class="invest">
    <router-view></router-view>
  </div>
</template>
<script>
export default {
  name: "invest",
  data() {
    return {
      plans: [
        { name: "Amazing Plan", price: "$100.00" },
        { name: "Unamazing plan", price: "$300" },
      ],
    };
  },
};
</script>
