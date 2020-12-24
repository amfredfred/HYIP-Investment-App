<template>
  <transition
    enter-active-class="animate__animated animate__fadeIn animate__faster"
    leave-active-class="animate__animated animate__fadeOut animate__faster"
    class
  >
    <div>
      <h3 class="page-title light-text">Dashboard</h3>
      <section class="mt-5">
        <div class="row">
          <div class="col-md-9 col-sm-7 mb-4">
            <div class="c-greeting p-4" v-if="adminInformation.user_detail">
              <h5 class="c-greeting__heading">
                Welcome back,
                <span class="text-danger">Admin</span>
                {{adminInformation.user_detail.first_name}}  {{adminInformation.user_detail.last_name}}!
              </h5>
              <p class="c-greeting__text">
                Total Balance for Users is
                <span class="text-success">${{totalMoney}}</span>
              </p>
            </div>
          </div>
          <div class="col-md-3 col-sm-5">
            <div class="c-balance p-4 shadow-sm">
              <div class="c-balance__main text-center">
                <h4>{{adminInformation.all_deposits}}</h4>
                <span class="c-balance__label">Total Deposits</span>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="account-summary">
        <h4 class="mb-4 account-summary__title light-text">Statistics</h4>
        <div class="row justify-content-between">
          <div class="col-sm-6 col-md-3">
            <div class="summary p-3 summary--active-deposit">
              <div class="row">
                <div class="col-3">
                  <div class="summary-icon">
                    <i class="fa fa-users p-3 rounded-circle"></i>
                  </div>
                </div>
                <div class="col-9">
                  <div class="summary-info">
                    <h6>Users</h6>
                    <h3>{{adminInformation.users}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="summary p-3 summary--total-deposit">
              <div class="row">
                <div class="col-3">
                  <div class="summary-icon">
                    <i class="fa fa-cubes p-3 rounded-circle"></i>
                  </div>
                </div>
                <div class="col-9">
                  <div class="summary-info">
                    <h6>Active Investments</h6>
                    <h3>{{adminInformation.active_investment}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="summary p-3 summary--last-deposit">
              <div class="row">
                <div class="col-3">
                  <div class="summary-icon">
                    <i class="fa fa-check p-3 rounded-circle"></i>
                  </div>
                </div>
                <div class="col-9">
                  <div class="summary-info">
                    <h6>Completed Investments</h6>
                    <h3>{{adminInformation.completed_investment}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="summary p-3 summary--last-withdraw">
              <div class="row">
                <div class="col-3">
                  <div class="summary-icon">
                    <i class="fa fa-hourglass-half p-3 rounded-circle"></i>
                  </div>
                </div>
                <div class="col-9">
                  <div class="summary-info">
                    <h6>Pending Investments</h6>
                    <h3>{{adminInformation.pending_investment}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="summary p-3 summary--active-deposit">
              <div class="row">
                <div class="col-3">
                  <div class="summary-icon">
                    <i class="fa fa-braille p-3 rounded-circle"></i>
                  </div>
                </div>
                <div class="col-9">
                  <div class="summary-info">
                    <h6>Total Withdrew</h6>
                    <h3>{{adminInformation.all_withdraws}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="summary p-3 summary--total-deposit">
              <div class="row">
                <div class="col-3">
                  <div class="summary-icon">
                    <i class="fa fa-exclamation-circle p-3 rounded-circle"></i>
                  </div>
                </div>
                <div class="col-9">
                  <div class="summary-info">
                    <h6>Pending Withdrew</h6>
                    <h3>{{adminInformation.withdraws_pending}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="summary p-3 summary--last-deposit">
              <div class="row">
                <div class="col-3">
                  <div class="summary-icon">
                    <i class="fa fa-battery-full p-3 rounded-circle"></i>
                  </div>
                </div>
                <div class="col-9">
                  <div class="summary-info">
                    <h6>Completed Withdrew</h6>
                    <h3>{{adminInformation.withdraws_complete}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="summary p-3 summary--last-withdraw">
              <div class="row">
                <div class="col-3">
                  <div class="summary-icon">
                    <i class="fa fa-database p-3 rounded-circle"></i>
                  </div>
                </div>
                <div class="col-9">
                  <div class="summary-info">
                    <h6>Total Plan</h6>
                    <h3>{{adminInformation.plans}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-3">
            <div class="summary p-3 summary--active-deposit">
              <div class="row">
                <div class="col-3">
                  <div class="summary-icon">
                    <i class="fa fa-credit-card-alt p-3 rounded-circle"></i>
                  </div>
                </div>
                <div class="col-9">
                  <div class="summary-info">
                    <h6>Total Payment Method</h6>
                    <h3>{{adminInformation.plans}}</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="account-overview">
        <div class="row">
          <div class="col-md-6 mb-5">
            <div class="c-recent-transactions lighter-text dark-bg--lighter px-5 py-4">
              <div class="row justify-content-between">
                <h5 class="c-recent-transactions__heading lighter-text">Recent Transactions</h5>
                <div class="more-arrow light-text">
                  <router-link to="#">
                    <span>
                      more
                      <i class="fa fa-long-arrow-right ml-2"></i>
                    </span>
                  </router-link>
                </div>
              </div>
              <div class="c-dashboard-list mt-5">
                <ul class="list-unstyled">
                  <li
                    v-for="(transaction, index) in adminInformation.admin_transaction"
                    :key="index"
                  >
                    <div class="c-dashboard-list__information">
                      <div class="row justify-content-between">
                        <div class="c-dashboard-list__info">
                          <h6
                            class="transaction-type lighter-text d-inline-block"
                          >{{transaction.name_type}} -</h6>
                          <span
                            class="transaction-amount d-inline-block light-text"
                          >${{transaction.amount}}</span>
                          <p>
                            <small>
                              <i class="fa fa-user"></i>
                            {{transaction.user.first_name}}  {{transaction.user.last_name}} 
                            </small>
                          </p>
                        </div>
                        <div class="c-dashboard-list__time">
                          <span class="c-dashboard-list__time--success">{{transaction.created_at}}</span>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="c-recent-transactions lighter-text dark-bg--lighter px-5 py-4">
              <div class="row justify-content-between">
                <h5 class="c-recent-transactions__heading lighter-text">Recent Investments</h5>
                <div class="more-arrow light-text">
                  <router-link to="#">
                    <span>
                      more
                      <i class="fa fa-long-arrow-right ml-2"></i>
                    </span>
                  </router-link>
                </div>
              </div>
              <div class="c-dashboard-list mt-5">
                <ul class="list-unstyled">
                  <li v-for="(investment, index) in adminInformation.admin_investment" :key="index">
                    <div class="c-dashboard-list__information">
                      <div class="row justify-content-between">
                        <div class="c-dashboard-list__info">
                          <h6 class="transaction-type d-inline-block lighter-text">Investment -</h6>
                          <span class="transaction-amount d-inline-block light-text">${{investment.amount}}</span>
                          <p>
                            <small>
                              <i class="fa fa-user"></i>
                              {{investment.user.last_name}} {{investment.user.first_name}}
                            </small>
                          </p>
                        </div>
                        <div class="c-dashboard-list__time">
                          <span class="c-dashboard-list__time--success">{{investment.created_at}}</span>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </transition>
</template>
<script>
/*
// Mock user information
name: "Sophie Turner",
        totalDeposit: 100,
        lastDeposit: 100,
        lastWithdraw: 100,
        activeDeposit: 100,
        balance: 4000,
        recentTransactions: [
          {
            transactionType: "withdraw",
            amount: 100,
            time: "9m ago"
          },
          {
            transactionType: "withdraw",
            amount: 100,
            time: "9m ago"
          },
          {
            transactionType: "withdraw",
            amount: 100,
            time: "9m ago"
          }
        ]
      */
export default {
  name: "dashboard-page-admin",
  data() {
    return {
      adminInformation: {},
      totalMoney: {}
    };
  },
  methods: {
    get_user_information() {
      const REQUEST_URL = "/user_dashboard/";
      axios
        .get(REQUEST_URL)
        .then(response => {
          this.adminInformation = response.data;
          this.totalMoney = response.data.total_money;
        })
        .catch(error => {
          console.log("error");
        });
    }
  },
  mounted() {
    this.get_user_information();
  }
};
</script>
<style lang="scss" scoped>
.c-greeting {
  background-color: hsl(229, 69%, 94%);
  border-radius: 20px;

  .c-greeting__heading {
    color: #3955d1;
  }

  .c-greeting__text {
    color: hsl(231, 12%, 44%);
  }
}

.c-balance {
  background-color: #fdfffc;
  border-radius: 20px;

  .c-balance__main {
    h1 {
      font-weight: bold;
      color: #414040;
    }

    .c-balance__label {
      font-size: 0.8rem;
      color: #696969;
    }
  }
}

.account-overview {
  margin-top: 6rem;
}

.c-recent-transactions {
  background-color: #fdfffc;
  border-radius: 20px;

  .c-recent-transactions__heading {
    font-size: 1.1rem;
    margin-bottom: 0;
    color: hsl(220, 9%, 38%);
  }

  .more-arrow {
    color: hsl(217, 6%, 44%);
    font-size: 0.9rem;
    a {
      color: inherit;
    }
  }
}

.c-dashboard-list {
  .c-dashboard-list__information {
    margin-bottom: 2.4rem;

    &::after {
      content: "";
      display: block;
      border-bottom: 1px solid hsla(0, 0, 15%, 0.1);
      margin-top: 0.5rem;
      padding: 0;
    }

    &::after:last-child {
      border-bottom: none;
    }
    .transaction-type {
      color: hsl(220, 9%, 38%);
    }
    .transaction-amount {
      color: hsl(217, 6%, 44%);
    }
    .c-dashboard-list__time {
      font-size: 0.8rem;

      .c-dashboard-list__time--success {
        color: #2d9e38;
      }

      .c-dashboard-list__time--danger {
        color: #ef233c;
      }

      .c-dashboard-list__time--info {
        color: #3955d1;
      }
    }
  }
}

.account-summary {
  margin-top: 6rem;
  .account-summary__title {
    font-size: 1.2rem;
    color: #545d65;
  }
  .summary {
    border-radius: 20px;
    margin-bottom: 0.8rem;
    .summary-icon {
      font-size: 0.9rem;
    }
    .summary-info {
      h6 {
        font-size: 0.9rem;
        font-weight: 400;
      }
      h3 {
        font-size: 1.3rem;
        font-weight: bold;
      }
    }
    &.summary--active-deposit {
      background-color: hsl(229, 58%, 47%);
      color: hsl(230, 46%, 88%);
      .summary-icon {
        i {
          background-color: #3b58d6;
        }
      }
    }
    &.summary--last-deposit {
      background-color: hsl(145, 58%, 41%);
      color: hsl(145, 46%, 87%);
      .summary-icon {
        i {
          background-color: hsl(145, 55%, 47%);
        }
      }
    }
    &.summary--last-withdraw {
      background-color: rgb(207, 62, 62);
      color: hsl(0, 50%, 87%);
      .summary-icon {
        i {
          background-color: rgb(224, 77, 77);
        }
      }
    }
    &.summary--total-deposit {
      background-color: #649ab4;
      color: #e1eef5;
      .summary-icon {
        i {
          background-color: #79b0cc;
        }
      }
    }
  }
}
</style>
