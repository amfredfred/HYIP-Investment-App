<template>
  <div class="menu" :class="{'menu--collapsed': menuCollapsed}">
    <div class="sidebar" ref="menu">
      <div class="logo">
        <img :src="logo" alt="logo" class="img-fluid" />
      </div>
      <div class="toggle-collapse mb-3 text-center">
        <a href @click.prevent="menuCollapsed = !menuCollapsed" class="text-light">
          <i class="fa fa-bars"></i>
        </a>
      </div>
      <ul class="sidebar__nav">
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'user-dashboard' }"
        >
          <i class="fa fa-home sidebar__nav-icon"></i>
          <router-link :to="{name: 'user-dashboard'}" class="sidebar__nav-link">Dashboard</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'user-deposit' }"
        >
          <i class="fa fa-money sidebar__nav-icon"></i>
          <router-link :to="{name: 'user-deposit'}" class="sidebar__nav-link">Invest</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'user-withdraw' }"
        >
          <i class="fa fa-handshake-o sidebar__nav-icon"></i>
          <router-link :to="{name: 'user-withdraw'}" class="sidebar__nav-link">Withdraw</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'transactions' }"
        >
          <i class="fa fa-calculator sidebar__nav-icon"></i>
          <router-link :to="{name: 'transactions'}" class="sidebar__nav-link">Transactions</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'user-referral' } "
        >
          <i class="fa fa-users sidebar__nav-icon"></i>
          <router-link :to="{name: 'user-referral'}" class="sidebar__nav-link">Referral</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'user-setting' }"
        >
          <i class="fa fa-cog sidebar__nav-icon"></i>
          <router-link :to="{name: 'user-setting'}" class="sidebar__nav-link">Settings</router-link>
        </li>
        <li class="sidebar__nav-item">
          <i class="fa fa-power-off sidebar__nav-icon"></i>
          <a href="/user-logout" class="sidebar__nav-link">Logout</a>
        </li>

        <li class="sidebar__nav-item">
          <a href="/user-logout" class="sidebar__nav-link">
            <i class="fa fa-moon sidebar__nav-icon"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "sidebar",
  data() {
    return {
      menuCollapsed: false,
    };
  },
  props: ["userType", "logo"],
  methods: {
    check_device_width() {
      if (window.innerWidth <= 768) {
        this.menuCollapsed = true;
      }
    },
  },
  mounted() {
    this.check_device_width();
  },
  watch: {
    $route(to, from) {
      this.check_device_width();
    },
  },
};
</script>
<style lang="scss" scoped>
$primary-color: blue;
$link-color: lighten($primary-color, 10);

.menu {
  display: block;
  width: 220px;
  transition: 0.3s;
  @media screen and (max-width: 576px) {
    width: auto;
  }
  .sidebar {
    padding: 2rem 1.5rem;
    height: 100vh;
    background-color: #7b5eea;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    overflow-x: hidden;
    z-index: 2;
    .logo {
      text-align: center;
      margin-bottom: 5rem;
      img {
        width: 90px;
      }
    }

    .sidebar__nav {
      list-style-type: none;
      margin: 0;
      padding: 1.4rem;

      .sidebar__nav-item {
        margin-bottom: 1.7rem;
        color: hsl(210, 18%, 85%);

        .sidebar__nav-icon {
          margin-right: 0.7rem;
        }

        .sidebar__nav-link {
          color: inherit;
          &:hover {
            text-decoration: none;
          }
        }

        &.sidebar__nav-item--active {
          i {
            color: hsl(209, 29%, 95%);
          }

          a {
            color: hsl(209, 29%, 90%);
          }
        }
      }
    }
  }
  &.menu--collapsed {
    width: 55px;
    .sidebar {
      padding: 1.3rem 0.1rem;
      .logo {
        text-align: center;
        margin-bottom: 5rem;
        img {
          width: 30px;
        }
      }
      .sidebar__nav {
        padding: 0.7rem;
        .sidebar__nav-link {
          display: none;
        }
      }
    }
  }
}
</style>
