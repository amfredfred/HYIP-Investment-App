<template>
  <div class="navigation">
    <div
      class="fixed top-0 z-10 w-full h-full bg-gray-700 md:block md:w-72 md:relative header-bar bg-opacity-50"
      :class="{hidden: hideNavbarMobile}"
      @click="hideNavbarMobile = true"
    >
      <div
        class="w-9/12 h-full overflow-y-auto bg-green-600 md:fixed md:h-screen p-9 sm:w-5/12 md:w-1/6"
        @click="$event.stopPropagation()"
      >
        <div class="mx-auto mb-12 sm:mb-16 md:mb-24 w-28 logo">
          <router-link :to="{name:'Dashboard'}">
            <img :src="logourl" class="max-w-full" alt="site logo" />
          </router-link>
        </div>
        <ul>
          <li v-for="(route, index) in routes" class="mb-10 text-lg" :key="index">
            <router-link :to="{name:route.name}">
              <i class="mr-3 fa" :class="route.icon"></i>
              {{route.name}}
            </router-link>
          </li>
          <li class="mb-10 text-lg">
            <a href>
              <i class="mr-3 fa fa-power-off"></i>
              Logout
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div
      class="fixed z-10 max-w-full bottom-5 right-1 md:hidden floating-hambuger"
      :class="{hidden: hideNavbarMobile == false}"
    >
      <button
        class="p-4 bg-green-600 rounded-full fa fa-bars text-green-50"
        @click="hideNavbarMobile = false"
      ></button>
    </div>
  </div>
</template>

<script>
export default {
  name: "navbar",
  data() {
    return {
      routes: [],

      hideNavbarMobile: true,
    };
  },

  props: ["logourl"],

  methods: {
    fetchRoutes() {
      this.$router.options.routes.forEach((route) => {
        if (route.children && route.children[0].path === "") {
          const defaultChildRoute = route.children[0];
          return this.routes.push({
            name: defaultChildRoute.name,
            icon: route.prop.icon,
          });
        }
        return this.routes.push({ name: route.name, icon: route.prop.icon });
      });
    },
  },

  created() {
    this.fetchRoutes();
  },
};
</script>

<style lang="scss" scoped>
a {
  @apply text-green-100 #{!important};
  &:hover {
    @apply text-green-100;
    text-decoration: none;
  }
}
</style>
