<template>
  <div class="shipping-info" style="margin-top : 100px ">
    <h4 class="text-h4 text-center q-mb-lg">{{$t('shipingInfo.title')}}</h4>
    <q-form @submit.prevent="shipping">
      <div class="container">
        <div class="row q-col-gutter-md ">
          <div class="col-12 col-md-8 col-lg-6">
            <div class="contact-info">
              <div class="flex items-center justify-between q-my-md">
                <h6 class="q-my-none">{{$t('shipingInfo.contact')}}</h6>
                <span v-if="!is_login" >{{$t('shipingInfo.check')}}
                  <span @click="loginFormCheckout" class="text-blue cursor-pointer" style="text-decoration: underline">{{$t('shipingInfo.login')}}</span>
                </span>
              </div>
              <q-input
                v-model="user.phone"
                outlined
                dense
                stack-label
                type="tel"
                :label="$t('shipingInfo.placeholderPhone')"
                lazy-rules
                suffix="966"
                hint="Mask: ### ### ###"
                :rules="[
                  val =>
                    (val && val.length > 0) || `${$t('shipingInfo.validation.phone')}`]"
              />
              <q-input
                v-model="user.name"
                outlined
                dense
                type="text"
                :label="$t('shipingInfo.placeholderName')"
                lazy-rules
                :rules="[
                  val => (val && val.length > 3) ||   `${$t('shipingInfo.validation.name')}`
                ]"
              />
              <q-input
                v-model="user.email"
                type="text"
                :label="$t('shipingInfo.placeholderEmail')"
                :rules="[val => validateEmail(val) ||  `${$t('shipingInfo.validation.email')}`]"
                outlined
                dense
              />
            </div>
            <div class="shipping-address">
              <h6 class="q-my-none q-mb-md">{{$t('shipingInfo.address')}}</h6>
              <q-input
                v-model="user.v"
                outlined
                dense
                type="text"
                :label="$t('shipingInfo.placeholderCity')"
                lazy-rules
                :rules="[val => (val && val.length) || `${$t('shipingInfo.validation.adress')}`]"
              />
              <q-input
                v-model="user.address"
                outlined
                dense
                type="text"
                :label="$t('shipingInfo.placeholderAddress')"
                lazy-rules
                :rules="[
                  val => (val && val.length) || `${$t('shipingInfo.validation.adress')}`
                ]"
              />

<!--              <div class="flex no-wrap justify-between q-mb-md">-->
<!--                <q-input-->
<!--                  v-model="user.country"-->
<!--                  type="text"-->
<!--                :label="$t('shipingInfo.placeholderCountry')"-->
<!--                  outlined-->
<!--                  :rules="[-->
<!--                    val => (val && val.length) || 'Please type your country'-->
<!--                  ]"-->
<!--                  dense-->
<!--                />-->
<!--                <q-input-->
<!--                  v-model="user.governorate"-->
<!--                  type="text"-->
<!--                :label="$t('shipingInfo.placeholderGov')"-->
<!--                  outlined-->
<!--                  :rules="[-->
<!--                    val => (val && val.length) || `${$t('shipingInfo.validation.country')}`]"-->
<!--                  dense-->
<!--                />-->
<!--                <q-input-->
<!--                  v-model="user.post_code"-->
<!--                  type="text"-->
<!--                  :label="$t('shipingInfo.placeholderPC')"-->
<!--                  outlined-->
<!--                  :rules="[-->
<!--                    val => (val && val.length) || `${$t('shipingInfo.validation.postCode')}`]"-->
<!--                  dense-->
<!--                />-->
<!--              </div>-->
                <app-button :label="$t('back')" url="" class="" :back="true" />

            </div>
          </div>
          <div class="col-12 col-md-4 col-lg-6">
            <total-cart style="margin-bottom: 15px"/>
            <q-btn
              class="semi-bold checkout-btn"
              color="primary"
                  :label="$t('shipingInfo.checkout')"
              type="submit"
              padding="7px 30px"
            />
          </div>
        </div>
      </div>
    </q-form>
  </div>
</template>

<script>
import TotalCart from "src/components/Checkout/TotalCart.vue";
import {account} from "src/mixins/account";
import {Cookies} from "quasar";
export default {
  components: { TotalCart },
  mixins: [account],
  data() {
    return {
      user: {
        name: "ahmed",
        phone: "0114628746",
        email: "a@a.asd",
        password: "",
        newPassword: "",
        city: "asd",
        country: "asd",
        address: "asd",
        governorate: "asdasd",
        post_code: null
      },
    };
  },
  methods: {
    async save( user ) {
      await this.$store.dispatch('account/update', user).then(res => {
        this.$router.push('/Checkout')
      })
    },
    shipping() {
      // this.save(this.user)
      this.$store.commit('account/UPDATA_GUEST', this.user)
      this.$router.push('/Checkout')
    },
    loginFormCheckout () {
      Cookies.set('checkOut', '/Checkout/information')
      this.$router.push('/Account/login')
    },
  },
   created() {
     // if(!this.is_login) {
     //   this.loginFormCheckout()
     // }
   }
};
</script>

<style lang="scss">
.shipping-address {
  margin-top: 50px;
}

@media (min-width: 1400px) {
  .checkout-btn {
    margin-left: 86px;
  }
}
@media (min-width: 500px) {
  .checkout-btn {
    margin-left: 84px;
  }
}
@media (max-width: 1400px) {
  .checkout-btn {
    margin-left: 60px;
  }
}
@media (max-width: 1200px) {
  .checkout-btn {
    margin-left: 0px;
    margin-bottom: 25px;
  }
}


</style>
