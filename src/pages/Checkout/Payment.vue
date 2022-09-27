<template>
  <div class="payment-checkout">
    <h4 class="text-h4 text-center q-mb-lg">{{$t("Payment.title")}}</h4>
    <div class="container q-mt-xl">
      <div class="row q-col-gutter-md ">
        <div class="col-12 col-md-8 col-lg-6">
          <div class="contact-box">
            <h6 class="q-my-none q-mb-md">{{$t("Payment.info")}}</h6>

            <q-list bordered separator>
              <q-item>
                <q-item-section avatar>
                  <span class="text-grey">{{$t('Payment.name')}}</span>
                </q-item-section>

                <q-item-section>{{ guest.name }}</q-item-section>
              </q-item>
              <q-item>
                <q-item-section avatar>
                  <span class="text-grey">{{$t('Payment.contact')}}</span>
                </q-item-section>

                <q-item-section>
                  {{ guest.phone}} {{ guest.email }}
                  </q-item-section>
              </q-item>
              <q-item>
                <q-item-section avatar>
                  <span class="text-grey">{{$t('Payment.ShipTo')}}</span>
                </q-item-section>

                <q-item-section
                  >
                  {{ guest.address }}, {{ guest.city }}, {{ guest.governorate }}, {{ guest.country }}, {{ guest.post_code }}</q-item-section
                >
              </q-item>
            </q-list>
          </div>

          <div class="payment-toogler q-mt-xl">
            <h6 class="q-my-none q-mb-md">{{$t('Payment.ShippingMethod.title')}}</h6>

            <q-radio v-model="credit_card" val="cash" :label="$t('Payment.ShippingMethod.cash')"  />
            <q-radio v-model="credit_card" val="visa" :label="$t('Payment.ShippingMethod.visa')" />

          </div>

          <div class="payment q-mt-lg" :class="{ muted: credit_card === 'cash' }">
            <h6 class="q-my-none q-mb-md">{{$t('Payment.paymentCard.PaymentTilte')}}</h6>
<!--            <q-banner class="bg-black text-white">-->
<!--              <template v-slot:avatar>-->
<!--                <q-icon  name="las la-frown" color="white" />-->
<!--              </template>-->
<!--             {{$t('Payment.paymentCard.error')}}-->
<!--            </q-banner>-->
            <div class="payment-card rounded-borders bg-grey-1 q-mb-lg">
              <header class="bg-white q-pa-md row">
                <span class="block text-subtitle2">{{$t('Payment.paymentCard.credit')}}</span>
                <q-space/>
                <q-img style="width: 21vw;" class="q-mx-md" src="visa.png"/>
              </header>
              <!-- Payment Form -->
<!--              <main class="q-pa-lg">-->
<!--                <div class="payment-form">-->
<!--                  <q-input-->
<!--                    v-model="credit.name"-->
<!--                    type="text"-->
<!--                    :label="$t('Payment.paymentCard.cardName')"-->
<!--                    outlined-->
<!--                    dense-->
<!--                    class="q-mb-md bg-white"-->
<!--                  />-->
<!--                  <q-input-->
<!--                    v-model="credit.number"-->
<!--                    type="text"-->
<!--                    :label="$t('Payment.paymentCard.cardNumber')"-->
<!--                    outlined-->
<!--                    dense-->
<!--                    class="q-mb-md bg-white"-->
<!--                  />-->
<!--                  <div class="row q-col-gutter-md">-->
<!--                    <div class="col-6">-->
<!--                      <q-input-->
<!--                        v-model="credit.expire_date"-->
<!--                        :label="$t('Payment.paymentCard.expiration')"-->
<!--                        outlined-->
<!--                        mask="##/##"-->
<!--                        hint="MM/YY"-->
<!--                        dense-->
<!--                        class="q-mb-md bg-white"-->
<!--                      />-->
<!--                    </div>-->
<!--                    <div class="col-6">-->

<!--                      <q-input-->
<!--                        v-model="credit.security_code"-->
<!--                        mask="###"-->
<!--                        hint="CVV2"-->
<!--                        :label="$t('Payment.paymentCard.securityCode')"-->
<!--                        outlined-->
<!--                        dense-->
<!--                        class="q-mb-md bg-white"-->
<!--                      />-->
<!--                    </div>-->
<!--                  </div>-->
<!--                </div>-->
<!--              </main>-->
            </div>
          </div>
          <app-button :label="$t('back')" url="" :back="true" class="q-mr-md" />
        </div>
        <div class="col-12 col-md-4 col-lg-6">
          <total-cart style="margin-bottom: 15px" />
          <app-button
            class="payment-btn"
            :loading="loading" @click.native="createOrder" :label="$t('create_order')" url="" :flat="false" />
        </div>
      </div>
    </div>
<!--    <script src="https://test.oppwa.com/v1/paymentWidgets.js?checkoutId={checkoutId}"></script>-->
<!--    <form action="https://hyperpay.docs.oppwa.com/tutorials/integration-guide" class="paymentWidgets" data-brands="VISA MASTER AMEX"></form>-->
  </div>
</template>
<script>
import TotalCart from "components/Checkout/TotalCart.vue";
import {Cookies} from "quasar";
import {api} from "boot/axios";
export default {
  components: { TotalCart },
  data() {
    return {
      credit_card: 'cash',
      loading: false,
      credit: {
        name: "",
        number: null,
        expire_date: null,
        security_code: null
      }
    };
  },
  computed: {
    is_login () {
      return this.$store.getters['account/is_login']
    },
    guest() {
      const user = this.$store.getters['account/guest']
      return user ? user : {}
    },
    subtotal() {
      return this.$store.getters["cart/subtotal"];
    },
    shippingCost() {
      return this.$store.getters["cart/shippingCost"];
    },
    offer() {
      return this.$store.getters["cart/offer"];
    },
    total () {
      let total = this.$store.getters['cart/subtotal'] + this.$store.getters['cart/shippingCost']
      if ( this.offer.id ) {
        total = total - ((total / 100) * this.offer.cost)
      }
      return total
    }
  },
  methods: {
     async createOrder () {
       this.loading = true
       const client_id = this.$store.getters['account/guest']
       client_id.id = client_id.id ? client_id.id : false
       // console.log(client_id)
       let payload = {
         client: client_id,
         payment_method: this.credit_card,
         products: this.$store.getters['cart/cartItems'],
         status: 'pending',
         sup_total: this.$store.getters['cart/subtotal'],
         shipping_cost: this.$store.getters['cart/shippingCost'],
         total: this.total,
         // credit: this.credit
       }
         this.loading = false
       Cookies.set('client_for_payment', this.$store.getters['account/guest']);
       console.log(Cookies.get('client_for_payment'))
       if (this.credit_card == "visa"){
         window.open(`https://sweet-api.alfatechegy.com/paymentForm/${payload.total}`, '_blank')
       } else {
         // create order
         this.$store.dispatch('order/createOrder',payload).then(()=>{
           this.$route.push('/profile');
         })
       }

    }
  },
  created() {
    if(!this.$store.getters['account/guest'].name)
      this.$router.push('/Checkout/information')
  }
};
</script>

<style lang="scss">
.payment {
  .payment-card {
    border: 1px solid rgba(0, 0, 0, 0.12);
    header {
      border-bottom: 1px solid rgba(0, 0, 0, 0.12);
    }
  }
}
.payment.muted {
  opacity: 0.5;
  cursor: not-allowed;
  pointer-events: none;
}

@media (min-width: 1400px) {
  .payment-btn {
    margin-left: 86px;
  }
}
@media (min-width: 500px) {
  .payment-btn {
    margin-left: 84px;
  }
}
@media (max-width: 1400px) {
  .payment-btn {
    margin-left: 60px;
  }
}
@media (max-width: 1200px) {
  .payment-btn {
    margin-left: 0px;
    margin-bottom: 25px;
  }
}
</style>
