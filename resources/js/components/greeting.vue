<template>
  <div class="page-greeting">
  <div class="row justify-content-between">
        <div class="greeting">
          <h3 class="page-title light-text">Hey, {{userFirstName}}</h3>
          <p>Secure your future</p>
        </div>
        <div>{{userFirstName}}  {{userLastName}}</div>
      </div>
  </div>
</template>
<script charset="utf-8">
export default {
  name: "headerGreeting",
  props: {
    userFirstName: String,
    userLastName: String
  },
}  
</script>
<style lang="sass" scoped>

</style>
