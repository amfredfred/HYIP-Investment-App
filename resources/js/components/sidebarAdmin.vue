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
          :class="{ 'sidebar__nav-item--active': $route.name === 'admin-dashboard' }"
        >
          <i class="fa fa-home sidebar__nav-icon"></i>
          <router-link :to="{name: 'admin-dashboard'}" class="sidebar__nav-link">Dashboard</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'manage-deposit' }"
        >
          <i class="fa fa-btc sidebar__nav-icon"></i>
          <router-link :to="{name: 'manage-deposit'}" class="sidebar__nav-link">Manage Deposits</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'manage-withdraw' }"
        >
          <i class="fa fa-window-maximize sidebar__nav-icon"></i>
          <router-link :to="{name: 'manage-withdraw'}" class="sidebar__nav-link">Manage Withdraws</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'manage-user' }"
        >
          <i class="fa fa-users sidebar__nav-icon"></i>
          <router-link :to="{name: 'manage-user'}" class="sidebar__nav-link">Manage User</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'manageplans' }"
        >
          <i class="fa fa-bookmark sidebar__nav-icon"></i>
          <router-link :to="{name: 'manageplans'}" class="sidebar__nav-link">Manage Plans</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'paymentmethods' }"
        >
          <i class="fa fa-credit-card sidebar__nav-icon"></i>
          <router-link :to="{name: 'paymentmethods'}" class="sidebar__nav-link">Payment Methods</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'managecompounds' }"
        >
          <i class="fa fa-calendar-o sidebar__nav-icon"></i>
          <router-link :to="{name: 'managecompounds'}" class="sidebar__nav-link">Manage Compounds</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'mailsystem' }"
        >
          <i class="fa fa-envelope-open sidebar__nav-icon"></i>
          <router-link :to="{name: 'mailsystem'}" class="sidebar__nav-link">Send Mail</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'web-setting' }"
        >
          <i class="fa fa-gavel sidebar__nav-icon"></i>
          <router-link :to="{name: 'web-setting'}" class="sidebar__nav-link">Web Settings</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'homepagesettings' }"
        >
          <i class="fa fa-home sidebar__nav-icon"></i>
          <router-link :to="{name: 'homepagesettings'}" class="sidebar__nav-link">Homepage Settings</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'pagesettings' }"
        >
          <i class="fa fa-globe sidebar__nav-icon"></i>
          <router-link :to="{name: 'pagesettings'}" class="sidebar__nav-link">Pages Settings</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'user-setting' }"
        >
          <i class="fa fa-cog sidebar__nav-icon"></i>
          <router-link :to="{name: 'user-setting'}" class="sidebar__nav-link">Settings</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'manage-faq' }"
        >
          <i class="fa fa-question sidebar__nav-icon"></i>
          <router-link :to="{name: 'manage-faq'}" class="sidebar__nav-link">Manage FAQ</router-link>
        </li>
        <!-- <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'manage-benefit' }"
        >
          <i class="fa fa-balance-scale sidebar__nav-icon"></i>
          <router-link :to="{name: 'manage-benefit'}" class="sidebar__nav-link">Manage Benefits</router-link>
        </li>
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'manage-get-started' }"
        >
          <i class="fa fa-bath sidebar__nav-icon"></i>
          <router-link
            :to="{name: 'manage-get-started'}"
            class="sidebar__nav-link"
          >Manage Get Started</router-link>
        </li> -->
        <li
          class="sidebar__nav-item"
          :class="{ 'sidebar__nav-item--active': $route.name === 'manage-social' }"
        >
          <i class="fa fa-bullhorn sidebar__nav-icon"></i>
          <router-link :to="{name: 'manage-social'}" class="sidebar__nav-link">Manage Social</router-link>
        </li>
        <li class="sidebar__nav-item">
          <i class="fa fa-power-off sidebar__nav-icon"></i>
          <a href="/user-logout" class="sidebar__nav-link">Logout</a>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
export default {
  name: "sidebarAdmin",
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
  width: 290px;
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
