<template>
  <div>
    <q-form @submit="getOrder(false)" class="row">
      <q-input
        v-model="orderRequest.email"
        type="email"
        class="col-12 col-md-6"
        :label="$t('shipingInfo.placeholderEmail')"
        :rules="[val => validateEmail(val) || `${$t('shipingInfo.validation.email')}`]"
        outlined
        dense
      />
      <q-input
        v-model="orderRequest.order_num"
        outlined
        dense
        :class="{ 'q-pl-md' : !$q.screen.lt.sm }"
        class="col-12 col-md-6"
        type="number"
        :label="$t('order.num')"
        lazy-rules
        :rules="[
              val => (val && val.length) || `${$t('order.validation.num')}`
            ]"
      />
      <appButton
        type="Track"
        :label="$t('save')"
        :flat="false"
        :loading="loadingBtn"
        class=" q-mb-md"
      />
    </q-form>

    <template v-if="order.id" >
      <order-info :order="order" />
    </template>
    <div v-if="loading" class="flex column flex-center">
      <h5 class="q-mb-md">{{$t('card.empty')}}</h5>
      <app-button url="/shop" :label="$t('ShopCard.return_back')" />
    </div>

  </div>
</template>

<script>
import {imagePalaceHolder} from "src/mixins/imagePalaceHolder";
import OrderInfo from "components/Account/tabs/order-info.vue";
export default {
  components: {OrderInfo},
  props: ['order_num'],
  mixins: [imagePalaceHolder],
  data() {
    return {
      loading: false,
      loadingBtn: false,
      orderRequest: {
        email: '',
        order_num: null
      },
    }
  },
  computed: {
    order () {
      return this.$store.getters['order/order']
    }
  },
  methods: {
    validateEmail(email) {
      const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(String(email).toLowerCase());
    },
    async getOrder (id = false) {
      let payload = {}
      if ( id ) {
        this.loading = true
        payload = { id : this.order_num }
      } else {
        this.loadingBtn = true
        payload = this.orderRequest
      }
      await this.$store.dispatch('order/getOrder', payload).then(res => {
        id ? this.loading = false : this.loadingBtn = false
      })
    }
  },
  mounted() {
    this.getOrder(true)
    this.orderRequest.email = this.$store.getters["account/guest"].email
  }
};
</script>

<style></style>
