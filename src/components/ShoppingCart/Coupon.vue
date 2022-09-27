<template>
  <div class="coupon q-mb-md">
    <q-btn
      color="primary"
      icon="las la-money-bill"
      :label="$t('card.coupon.title')"
      size="md"
      class="full-width"
      @click="coupon = true"
    >
      <q-tooltip
        anchor="top middle"
        self="bottom middle"
        :offset="[10, 10]"
        content-style="background-color: #000"
      >
        <strong>{{$t('card.coupon.discount')}}</strong>
      </q-tooltip>
    </q-btn>
    <div v-if="coupon" class="coupon-form q-my-lg">
      <transition appear leave-active-class="animated fadeInLeft slower" enter-active-class="animated fadeInRight slower" >
        <h6 v-if="status && error" class="q-my-sm">
          <q-icon name="sentiment_satisfied_alt" size="md" color="teal" />
          {{$t('card.coupon.validCoupon')}}
        </h6>
        <h6 v-if="status && !error" class="q-my-sm">
          <q-icon name="sentiment_satisfied_alt" size="md" color="red" />
          {{$t('card.coupon.invalidCoupon')}}
        </h6>
      </transition>
      <transition v-if="!status"  appear enter-active-class="animated fadeInRight slower">
        <h6  class="q-my-sm">
        {{$t('card.coupon.discount')}}
        </h6>
      </transition>
      <q-input v-model="code" outlined placeholder="Enter discount code here" type="text" />
      <app-button label="Save" :flat="false" :loading="loading" @click.native="getCoupon()" class="full-width q-my-md" />
      <button class="cancel-btn" @click="coupon = false">{{$t('cancel')}}</button>
    </div>
  </div>
</template>

<script>
import { LocalStorage } from "quasar";

export default {
  data() {
    return {
      code: null,
      coupon: false,
      loading: false,
      status: false,
      error: false
    };
  },
  methods: {
    async getCoupon() {
      this.loading = true
      await this.$store.dispatch('cart/getOffer', {code: this.code})
        .then(res => {
          const response = res.data
          this.loading = false
          this.status = true
          if (response.id) {
            LocalStorage.set('offer', JSON.stringify(response))
            this.error = true
          }
          else
            this.error = false
        })
    }
  }
};
</script>

<style lang="scss">
.cancel-btn {
  all: unset;
  width: 100%;
  color: $grey;
  text-decoration: underline;
  text-align: center;
  font-size: 16px;
  cursor: pointer;
}
</style>
