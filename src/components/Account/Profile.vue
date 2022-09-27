<template>
  <base-cart>
    <div class="container">
      <q-tabs
        v-model="tab"
        dense
        class="text-grey q-mt-md"
        active-color="primary"
        indicator-color="primary"
        align="justify"
        narrow-indicator
      >
        <q-tab v-for="(t, i) in compTabs.tabs" :key="i" :name="i" :icon="t.icon" >
          <q-tooltip
            v-if="!$q.screen.lt.md"
            anchor="top middle"
            self="bottom middle"
            :offset="[10, 10]"
            content-style="background-color: #000"
          >
            <strong class="text-capitalize">{{ t.tooltip }}</strong>
          </q-tooltip>
        </q-tab>
      </q-tabs>

      <q-separator />

      <q-tab-panels v-model="tab" animated>
        <q-tab-panel v-for="(t, i) in compTabs.tabs" :key="i" :name="i">
          <section-title class="q-my-md">{{ t.title }}</section-title>
          <profile-tab v-if="i === 'info'" />
          <template v-if="i === 'orders'">
            <orders-tab
              v-if="orders.data.length"
              :orders="orders"
              @pagination="getOrders"
              @singleOrder="changeTab"
            />
            <div v-else class="empty-cart text-center">
              <h5 class="q-mb-md">{{$t('firstOrder')}}</h5>
              <app-button url="/shop" :label="$t('ShopCard.return_back')" />
            </div>
          </template>
          <singel-order-tab :order_num="order_num" v-if="i === 'track_order'" />
        </q-tab-panel>
      </q-tab-panels>

    </div>
  </base-cart>
</template>

<script>
import BaseCart from "../UI/BaseCart.vue";
import SectionTitle from "../UI/SectionTitle.vue";
import {account} from "src/mixins/account";
import ProfileTab from "components/Account/tabs/profile-tab";
import OrdersTab from "components/Account/tabs/orders-tab";
import SingelOrderTab from "components/Account/tabs/singel-order-tab";
export default {
  components: {SingelOrderTab, OrdersTab, ProfileTab, BaseCart, SectionTitle },
  mixins: [account],
  data() {
    return {
      tab: 'info',
      order_num: 0,
      // tabs: {
      //   info: {
      //     title:this.$t('tabs.info.title'),
      //     icon: 'las la-user-alt',
      //     tooltip: this.$t('tabs.info.tooltip')
      //   },
      //   orders: {
      //     title: this.$t('tabs.orders.title'),
      //     icon: 'las la-list-alt',
      //     tooltip: this.$t('tabs.orders.tooltip'),
      //   },
      //   track_order: {
      //     title: this.$t('tabs.track_order.title'),
      //     icon: 'las la-history',
      //     tooltip: this.$t('tabs.track_order.tooltip'),
      //   },
      // }
    }
  },
  computed: {
    orders () {
      const orders = this.$store.getters['order/orders']
      return orders
    },
    compTabs () {
  return{
      tabs: {
        info: {
          title:this.$t('tabs.info.title'),
          icon: 'las la-user-alt',
          tooltip: this.$t('tabs.info.tooltip')
        },
        orders: {
          title: this.$t('tabs.orders.title'),
          icon: 'las la-list-alt',
          tooltip: this.$t('tabs.orders.tooltip'),
        },
        track_order: {
          title: this.$t('tabs.track_order.title'),
          icon: 'las la-history',
          tooltip: this.$t('tabs.track_order.tooltip'),
        },
      }

      }
    },
  },
  methods: {
    changeTab(num) {
      this.order_num = num
      this.tab = 'track_order'
    },
    update () {
      this.loading = true
      this.$store.dispatch('account/update', this.user).then(res => {
        this.updateProfile(res.data.user)
      })
    },
    getOrders(page) {
      this.$store.dispatch('order/getOrders',  {
        id: this.$store.state.account.user.id,
        page: page
      });
    },
  },
  mounted() {
    this.tab = this.$route.params.tab
    this.$store.dispatch('order/getOrders', {
      id: this.user.id,
    })
    console.log(this.compTabs);
  }

};
</script>

<style></style>
