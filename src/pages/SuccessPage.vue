<template>
<!-- translate not compleit -->
  <q-page>

    <div class="row items-center">
      <div class="col-12 text-center ">
        <q-img width="600px" src="/payment.png" />
      </div>
      <div class="col-12 ">
        <h3 class="text-center q-mb-sm">  {{ $t('success_payment') }}   </h3>
      </div>
    </div>
    <services class="q-mt-xl" />
  </q-page>
</template>

<script>
import Breadcrumbs from "components/UI/Breadcrumbs";
import Banner from "components/Banner/Banner";
import Services from "components/Services/Services";
import routes from "src/router/routes";
import {Cookies} from "quasar";
export default {
  components: {Services },
  name: "Payment Status",
  data() {
    return {
      counter: 30,
      checkout_id: '',

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
    getCheckoutId () {
      const fist_index = window.location.href.indexOf('=')
      const last_index = window.location.href.indexOf('&')
      this.checkout_id = window.location.href.slice(fist_index + 1, last_index)
      this.$store.dispatch('order/SendCheckoutId', Object.assign({}, {id: this.checkout_id}))
      // if checkout payment status done
        const client_id = this.$store.getters['account/guest']
        client_id.id = client_id.id ? client_id.id : false
        console.log(client_id)
        const payload = {
          id:this.checkout_id,
          client: Cookies.has('client_for_payment') ? Cookies.get('client_for_payment') : '',
          payment_method: 'visa',
          products: this.$store.getters['cart/cartItems'],
          status: 'pending',
          sup_total: this.$store.getters['cart/subtotal'],
          shipping_cost: this.$store.getters['cart/shippingCost'],
          total: this.total,
          currency: this.$store.getters['cart/currency'],
          credit: this.credit
        }
      console.log(payload)
        this.$store.dispatch('order/createOrder', payload).then(res => {
          // window.close()
          if (res.status) {
            this.$store.commit('cart/EMPTY_CART')
            Cookies.remove('cart')
            Cookies.remove('client_for_payment')
            this.$q.notify({
              message: 'Order successfully created',
              color: 'white',
              textColor: 'black',
              timeout: 3000,
            })
            setTimeout(() => {
              this.$q.notify({
                message: 'you will be redirect in 3 seconds',
                color: 'white',
                textColor: 'black',
                timeout: 3000,
              })
              this.$router.push('/Account/profile/orders')
              // window.close();
            },3000)

            // this.$router.push('/Account/profile/orders')
          } else {
            // message error
          }
        }).catch(err => {
          this.loading = false
          console.log(err)
        })

    }
  },
  mounted() {


    this.getCheckoutId()
  },

  created() {
    // if(!this.$store.getters['account/guest'].name)
    //   this.$router.push('/Checkout/information')
  }

};
</script>

<style lang="scss" scoped >

</style>
